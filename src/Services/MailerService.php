<?php

namespace App\Services;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MailerService extends AbstractController{

    public function __construct (\Swift_Mailer $mailer) {
        $this->swift_mailer = $mailer;
    }

    public function sendBooking ($Booking) {
        $sujet = 'Order confirmation';

        $message = "<div style='width:100%; height:50px; display:flex; align-items:center;justify-content:flex-start;background:black; color:white;'><img src='https://louvrep4oc.citrovsandbox.fr/img/logo-louvre.png' height='40'/><h3 style='margin-left:20px;'>Louvre Museum</h3></div>".
        "<p>Congratulations ! Your order is confirm ! Your Booking Reference is the <strong>" . $Booking->getReference() . "</strong>. Please show this email at the entrance to enjoy the Louvre.</p>".
        "<p>Here are the following persons on your order :</p>".
        "<ul>";

        foreach($Booking->getTickets() as $ticket) {
            $message .= "<li>" . $ticket->getFirstName() . " ". $ticket->getLastName() ."</li>";
        }

        $message .= "</ul><br>";
        $message .= "<small>Please do not forget that if you are under a reduction status, you could have to show your ID or any kind of proof at any time.</small>";


        $destinataire = $Booking->getPurchaserEmail();
        $headers = "From: \"Louvre Museum\"<louvre@citrovsandbox.fr>\n";
        $headers .= "Reply-To: louvre@citrovsandbox.fr\n";
        $headers .= "Content-Type: text/html; charset=\"UTF-8\"";
        if(mail($destinataire,$sujet,$message,$headers)) {
            return true;
        } else {
            return false;
        }
    }

}