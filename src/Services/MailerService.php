<?php

namespace App\Services;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MailerService extends AbstractController{

    public function __construct (\Swift_Mailer $mailer) {
        $this->swift_mailer = $mailer;
    }
    public function sendBooking ($Booking) {
        $message = (new \Swift_Message('Congratulations!'))
        ->setFrom('citrovsandbox@gmail.com')
        ->setTo('vmm1996@gmail.com')
        ->setBody(
            $this->renderView(
                'email_templates/order_confirm.html.twig',
                [
                    'name' => 'toto',
                    'bookingReference' => $Booking->getReference(),
                    'tickets' => $Booking->getTickets()
                ]
            ),
            'text/html'
        );
            
        $this->swift_mailer->send($message);
    }

}