<?php

namespace App\Controller\MaillerController;

use Symfony\Component\Mime\Address;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;


class MaillerController extends AbstractController
{
    /**
    * @Route("/mail", name="mail")
    */
    public function mailer(MailerInterface $mailer){
    $email = (new TemplatedEmail())
    ->from(new Address('alienmailcarrier@example.com', 'Webpage'))
    ->to(new Address('jab.pio@wp.pl', 'Piter'))
    ->subject('Welcome to the Space Bar!')
    ->htmlTemplate('message.html.twig');
        $mailer->send($email);
        return $this->render('message.html.twig');
    }
}