<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



class ApiController extends AbstractController
{
    /**
    * @Route("/register", name="register")
    */
    public function register(Request $request, UserPasswordEncoderInterface $encoder, EntityManagerInterface $em)
    {
        // return new Response($request);
        $email= $request->request->get('email');
        $password= $request->request->get('password');

        $user = new User();
        $user->setPassword($encoder->encodePassword($user, $password));
        $user->setEmail($email);
        $em->persist($user);
        $em->flush();

        return new Response(sprintf("User %s was succ created", $user->getUsername()));
    }

    public function api() {
        return new Response(sprintf("Logged in as %s", $user->getUsername()));
    }
}
