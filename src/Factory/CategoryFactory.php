<?php
// src/Factory\CategoryFactory.php
namespace App\Factory;
use App\Entity\Category;
use App\Entity\Emploi;
use App\Entity\Immo;
use App\Entity\Automobile;

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
            $this->_createCatgoryObject(json_decode($data));

            $annonce=$this->serializer->deserialize($data,Post::class,'json');
            $this->entityManager->persist($annonce);
            $this->entityManager->flush();

            return $annonce;
        }
        catch (NotEncodableValueException $e){
            dd($e);
            return $this->json([
                'status' => 400,
                'message' => 'Syntax Error'
            ]);
        }


    }


    private function  _createCatgoryObject($data){
        $typeCategory = $data->category->type;
        $dataCategory = $data->category->data;
        dump($dataCategory);
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
}
