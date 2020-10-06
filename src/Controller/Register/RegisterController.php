<?php


namespace App\Controller\Register;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{
    /**
    * @Route("/register", name="Register")
    */
    public function index(Request $request, UserPasswordEncoderInterface $encoder, EntityManagerInterface $em){
        $email = $request->query->get("username");
        $password = $request->query->get("password");
        $user = $em->getRepository(User::class)->findOneBy(['email'=>$email]);
        if(is_null($user)) {
            $user = new User();
            $user->setEmail($email);
            $user->setPassword($encoder->encodePassword($user, $password));
            $user->setRoles(["ROLE_USER"]);
            $em->persist($user);
            $em->flush();
            return new Response("User has been created",Response::HTTP_CREATED,['Content-Type' => 'application/json']);
        } else {
            return new Response("Given user already exists",Response::HTTP_CONFLICT,['Content-Type' => 'application/json']);
        }
    }
}