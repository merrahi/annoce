<?php

namespace App\Controller;
use App\Entity\Post;
use App\Entity\ListCategory;
use App\Factory\CategoryFactory;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

class AnnonceController extends AbstractController
{
    /**
     * @Route("/api/list/{id}", name="list_annonce",methods={"GET"})
     */
    public function list( $id, EntityManagerInterface $entityManager): Response
    {
        try{
            $annonce = $this->getDoctrine()->getRepository(Post::class)->find($id);
            // return result
            return $this->json( $annonce,Response::HTTP_OK,[],['groups' => 'listegroupe:create']);
        }
        catch (NotEncodableValueException $e){
            return $this->json([
                'status' => 400,
                'message' => 'Syntax Error'
            ]);
        }
    }

    /**
    * @Route("/api/create", name="create_annonce",methods={"POST"})
    */
    public function create(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer,CategoryFactory $categoryFactory): Response
    {
        try{
            // get result from request
            $annoncejson = $request->getContent();
            // create Post in database
            $annonce=$categoryFactory->createNewFactoryList($annoncejson);
            // return result
            return $this->json( $annonce,Response::HTTP_CREATED,[],['groups' => 'listegroupe:create']);
        }
        catch (NotEncodableValueException $e){
            return $this->json([
                'status' => 400,
                'message' => 'Syntax Error'
            ]);
        }
    }

    /**
     * @Route("/api/edit/{id}", name="list_annonce",methods={"PUT"})
     */
    public function edit( $id,Request $request, EntityManagerInterface $entityManager,CategoryFactory $categoryFactory): Response
    {
        try{
            // get result from request
            $annoncejson = $request->getContent();
            $editAnnonce = $this->getDoctrine()->getRepository(Post::class)->find($id);
            if($editAnnonce === null){
               // new Throw
                    throw $this->createNotFoundException(
                        'No post found for id '.$id
                    );
            }
            // edit Post in database
            $annonce=$categoryFactory->editFactoryList($annoncejson,$editAnnonce);
            // return result
            return $this->json( $annonce,Response::HTTP_OK,[],['groups' => 'listegroupe:edit']);
        }
        catch (\Exception $e){
            return $this->json([
                'status' => 400,
                'message' => 'Syntax Error',
                'Details' => $e->getMessage()
            ]);
        }
    }

    /**
     * @Route("/api/delete/{id}", name="delete_annonce",methods={"DELETE"})
     */
    public function delete($id, EntityManagerInterface $entityManager): Response
    {
        try{
            $annonce = $this->getDoctrine()->getRepository(Post::class)->find($id);

            $entityManager->remove($annonce);
            $entityManager->flush();
            // return result
            return $this->json( $annonce,Response::HTTP_ACCEPTED,[],['groups' => 'listegroupe:create']);
        }
        catch (NotEncodableValueException $e){
            return $this->json([
                'status' => 400,
                'message' => 'Syntax Error'
            ]);
        }
    }
}
