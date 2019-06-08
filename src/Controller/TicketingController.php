<?php

namespace App\Controller;

use App\Controller\BaseController;
use Symfony\Component\Routing\Annotation\Route;

use \Mailjet\Resources;



class TicketingController extends BaseController
{
    /**
     * @Route("/ticketing", name="ticketing")
     */
    public function index()
    {
        return $this->render('ticketing/index.html.twig', [
            'controller_name' => 'TicketingController',
            'page_name' => 'ticketing'
        ]);
    }
    /**
     * @Route("/testmail", name="test")
     */
    public function test () {
            $sujet = 'Order confirmation';
            $message = "Bonjour,
            Ceci est un <strong>LONG</strong> message texte envoyé grâce à  php.
            merci :)";
            $destinataire = 'vmm1996@gmail.com';
            $headers = "From: \"Louvre Museum\"<louvre@citrovsandbox.fr>\n";
            $headers .= "Reply-To: louvre@citrovsandbox.fr\n";
            $headers .= "Content-Type: text/html; charset=\"UTF-8\"";
            
            if(mail($destinataire,$sujet,$message,$headers)) {
                return $res = $this->httpRes(403, "The mail is sent.", "{}");
            } else {
                return $res = $this->httpRes(403, "The mail is NOT sent.", "{}");
            };
    }
}
