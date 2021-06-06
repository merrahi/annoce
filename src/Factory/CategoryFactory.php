<?php
// src/Factory\CategoryFactory.php
namespace App\Factory;
use App\Entity\Category;
use App\Entity\Emploi;
use App\Entity\Immo;
use App\Entity\Automobile;

use App\Entity\ListCategory;
use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Serializer\SerializerInterface;

class CategoryFactory
{
    private $serializer;
    private $entityManager;

    public function __construct(SerializerInterface $serializer,EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager ;
        $this->serializer = $serializer ;
    }

    public function createNewFactoryList( $data)
    {
        try{
            $dataObject=json_decode($data);
            $cat=$this->_createCatgoryObject($dataObject);
            $annonce=$this->serializer->deserialize($data,Post::class,'json');

            //set list of gategory
            $this->entityManager->persist($annonce);
            $this->entityManager->flush();
           // Link Post with Category
            $listCategory=new ListCategory();
            //dump($cat);
            switch ($dataObject->category->type){
                case 'emploi' : $listCategory->setEmploi($cat);
                    break;
                case 'immmo' : $listCategory->setImmo($cat);;
                    break;
                case 'automobile' : $listCategory->setAutomobile($cat);
                    break;
                default: break;
            }
            $listCategory->setPost($annonce);
            //set list of gategory
            $this->entityManager->persist($listCategory);
            $this->entityManager->flush();
            //$listCategory->setEmploi();
            //dump($listCategory);
            //dd($dataObject->category->type);
            return $listCategory;
        }
        catch (NotEncodableValueException $e){
            return $this->json([
                'status' => 400,
                'message' => 'Syntax Error'
            ]);
        }


    }


    private function  _createCatgoryObject($data){
        $typeCategory = $data->category->type;
        $dataCategory = $data->category->data;
        //dump($dataCategory);
        if(isset($typeCategory)){
            switch ($typeCategory){
                case 'emploi' : $catList= $this->serializer->deserialize(json_encode($dataCategory),Emploi::class,'json');
                                break;
                case 'immmo' : $catList= $this->serializer->deserialize(json_encode($dataCategory),Immo::class,'json');
                    break;
                case 'automobile' : $catList= $this->serializer->deserialize(json_encode($dataCategory),Automobile::class,'json');
                    break;
                default: break;
            }

            //getCategory from Category
            $category = $this->entityManager->getRepository(Category::class)->findOneByName($typeCategory);
            $catList->setCategory($category);
            $this->entityManager->persist($catList);
            $this->entityManager->flush();
            return $catList;
        }
        return false;

    }


    public function editFactoryList( $data,$postId)
    {


        try{
            $dataObject=json_decode($data);
            // Link Post with Category
            $postId->setTitle($dataObject->title);
            $postId->setContent($dataObject->content);
            $listCategory=$postId->getListCategory();
            $emploi = $listCategory->getEmploi();
            $immo = $listCategory->getImmo();
            $automobile = $listCategory->getAutomobile();
            //dump($cat);
            switch ($dataObject->category->type){
                case 'emploi' :  $emploi->setSalaire($dataObject->category->data->salaire);
                                 $emploi->setContractType($dataObject->category->data->contract_type);
                                $this->entityManager->persist($emploi);
                    break;
                case 'immmo' :  $immo->setSurface($dataObject->category->data->surface);
                                $immo->setPrice($dataObject->category->data->price);
                                    $this->entityManager->persist($immo);
                    break;
                case 'automobile' : $automobile->setFuel($dataObject->category->data->fuel);
                                    $automobile->setPrice($dataObject->category->data->price);
                                    $this->entityManager->persist($automobile);

                    break;
                default: break;
            }



            $this->entityManager->persist($postId);
            $this->entityManager->flush();

            return $listCategory;
        }
        catch (NotEncodableValueException $e){
            return $this->json([
                'status' => 400,
                'message' => 'Syntax Error'
            ]);
        }


    }
}
