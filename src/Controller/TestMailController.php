<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Services\MailerService;

use App\Entity\Booking;

class TestMailController extends AbstractController
{
    public function __construct (MailerService $MailerService) {
        $this->mailer = $MailerService;
    }
    /**
     * @Route("/test/mail", name="test_mail")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Booking::class);
        $Booking = $repository->findOneByReference("0EQGIO9D31QJ4WA306YQ");
        
        $this->mailer->sendBooking($Booking);
        return $this->render('test_mail/index.html.twig', [
            'controller_name' => 'TestMailController',
            'page_name' => 'success_mail'
        ]);
    }
}
