<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class MailController extends AbstractController
{
    #[Route('/send-test-email')]
    public function sendTestEmail(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('noreply@example.com')
            ->to('test@example.com')
            ->subject('Test Email')
            ->text('Ceci est un test depuis Symfony!');

        $mailer->send($email);

        return new Response('Email envoyé!');
    }
}
