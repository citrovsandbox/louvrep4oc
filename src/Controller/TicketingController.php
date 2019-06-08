<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;



class TicketingController extends AbstractController
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
        $to = 'vmm1996@gmail.com';

        $subject = 'Order confirmation';
        
        $headers = "From: Louvre Museum \r\n";
        $headers .= "Reply-To: vmm1996@gmail.com \r\n";
        $headers .= "CC: susan@example.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        
        $message = '<p><strong>This is strong text</strong> while this is not.</p>';
        
        
        mail($to, $subject, $message, $headers);
        return $this->render('ticketing/index.html.twig', [
            'controller_name' => 'TicketingController',
            'page_name' => 'ticketing'
        ]);
    }
}
