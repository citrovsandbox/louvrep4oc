<?php

namespace App\Controller;

use App\Controller\BaseController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

use App\Entity\Booking;

use App\Services\PaymentService;
use App\Services\MailerService;

class PayController extends BaseController
{

    public function __construct (MailerService $MailerService, PaymentService $PaymentService) {
        $this->stripe = $PaymentService;
        $this->mailer = $MailerService;
    }
    /**
     * @Route("/pay", name="pay")
     */
    public function index(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $client_token = $data["token"];
        $booking_ref = $data["bookingRef"];
        $Manager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(Booking::class);
        $Booking = $repository->findOneByReference($booking_ref);

        if($this->stripe->makeTransaction($client_token, $Booking)) {
            $Booking->setValidated(true);
            $Manager->persist($Booking);
            $Manager->flush();
            $this->mailer->sendBooking($Booking);
            $res = $this->httpRes(200, "Payment is ok.", "{}");
        } else {
            $res = $this->httpRes(500, "Payment is NOT ok.", "{}");
        }
        
        return $res;
    }
}
