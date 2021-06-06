<?php

namespace App\Controller;
use App\Entity\Post;
use App\Entity\ListCategory;
use App\Factory\CategoryFactory;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

class AnnonceController extends AbstractController
{
    /**
     * @Route("/api/create", name="create_annonce",methods={"POST"})
     */
    public function create(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer,CategoryFactory $categoryFactory): Response
    {
        try{
            $annoncejson = $request->getContent();
            dump($annoncejson);
            //$listCategoryData=json_decode($annoncejson);
            $categoryFactory->createNewFactoryList($annoncejson);
            /*dd($listCategoryData->listCategory);
            $annonce=$serializer->deserialize($annoncejson,Post::class,'json');
            $listCategory=$serializer->deserialize($listCategoryData->listCategory,ListCategory::class,'json');
            dd($listCategory,$annonce);
            $entityManager->persist($annonce);
            $entityManager->flush();*/

            return $this->json( $annonce,201,[],['groups' => 'annonce:read']);

            $data = json_decode($request->getContent(), true);

            $firstName = $data['firstName'];
            $lastName = $data['lastName'];
            $email = $data['email'];
            $phoneNumber = $data['phoneNumber'];

            if (empty($firstName) || empty($lastName) || empty($email) || empty($phoneNumber)) {
                throw new NotFoundHttpException('Expecting mandatory parameters!');
            }

            $this->customerRepository->saveCustomer($firstName, $lastName, $email, $phoneNumber);

            return new JsonResponse(['status' => 'Annonce created!'], Response::HTTP_CREATED);
        }
        catch (NotEncodableValueException $e){
            return $this->json([
                'status' => 400,
                'message' => 'Syntax Error'
            ]);
        }
    }
}
