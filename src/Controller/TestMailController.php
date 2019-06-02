<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TestMailController extends AbstractController
{
    /**
     * @Route("/test/mail", name="test_mail")
     */
    public function index(\Swift_Mailer $mailer, \Knp\Snappy\Pdf $snappy)
    {
        $message = (new \Swift_Message('Congratulations!'))
        ->setFrom('citrovsandbox@gmail.com')
        ->setTo('vmm1996@gmail.com')
        ->setBody(
            $this->renderView(
                'email_templates/order_confirm.html.twig',
                // 'emails/registration.html.twig',
                ['name' => 'toto']
            ),
            'text/html'
        )
        /*
         * If you also want to include a plaintext version of the message
        ->addPart(
            $this->renderView(
                'emails/registration.txt.twig',
                ['name' => $name]
            ),
            'text/plain'
        )
        */
        ;
        $html = $this->renderView("email_templates/ticket.html.twig",
        // 'emails/registration.html.twig',
        ['name' => 'toto']);
        $filename = __DIR__ . "billet_1.pdf";
        $pdf = $snappy->getOutputFromHtml($html);
        $attachement = \Swift_Attachment::newInstance($pdf, $filename, 'application/pdf' );
        $message->attach($attachement);
        // $mailer->send($message);
        return $this->render('test_mail/index.html.twig', [
            'controller_name' => 'TestMailController',
            'page_name' => 'success_mail'
        ]);
        // return $this->render('email_templates/order_confirm.html.twig', [
        //     'controller_name' => 'TestMailController',
        //     'page_name' => 'success_mail'
        // ]);
    }
}
