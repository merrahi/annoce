<?php

namespace App\Controller;
use App\Entity\User;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\SerializerInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/register", name="api_register", methods={"GET","POST"})
     */
    public function register(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        try{
            $userjson = $request->getContent();
            $user=$serializer->deserialize($userjson,User::class,'json');
            //encode the password
            $user->setPassword($passwordEncoder->encodePassword($user, $user->getPassword()));
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->json( $user,201,[],['groups' => 'user:read']);
        }
        catch (NotEncodableValueException $e){
            return $this->json([
                'status' => 400,
                'message' => 'Syntax Error'
            ]);
        }


        dd($userjson);
    }

    /**
     * @Route("/login", name="api_login")
     */
    public function login(AuthenticationUtils $authenticationUtils,Request $request): Response
    {
        dd();
        $lastUsername = $authenticationUtils->getLastUsername();
        $error = $authenticationUtils->getLastAuthenticationError();
        dd($request->getContent());

        return $this->json( [
            'last_username' => $lastUsername,
            'error' => $error,
            'current_menu' => 'login'
        ]);
       /* return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UserController.php',
        ]);*/


        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $return = ['last_username' => $lastUsername, 'error' => $error];
        dd($return);


        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $return = ['last_username' => $lastUsername, 'error' => $error];

        if($session->has('message'))
        {
            $message = $session->get('message');
            $session->remove('message'); //on vide la variable message dans la session
            $return['message'] = $message; //on ajoute à l'array de paramètres notre message
        }

        return $this->render('security/login.html.twig', $return);
    }
}
