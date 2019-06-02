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

class PayController extends BaseController
{
    /**
     * @Route("/pay", name="pay")
     */
    public function index(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $client_token = $data["token"];
        $booking_ref = $data["bookingRef"];
        $success = true;
        $err = '';
        try {
            $Manager = $this->getDoctrine()->getManager();
            $repository = $this->getDoctrine()->getRepository(Booking::class);
            $Booking = $repository->findOneByReference($booking_ref);

            \Stripe\Stripe::setApiKey("sk_test_xWJBmr6VQPy0rBB2LRFfFUia00lqfnoclU");
            $charge = \Stripe\Charge::create(array(
                "amount" => $Booking->getPrice() * 100, // prix * en centimes
                "currency" => "eur",
                "source" => $data["token"],
                "description" => "Commande effectuée via la boutique"
            ));
        } catch(\Stripe\Error\Card $e) {
            $success = false;
            $err = "Payment - $e";
        }

        if($success) {
            $Booking->setValidated(true);
            $Manager->persist($Booking);
            $Manager->flush();
            $res = $this->httpRes(200, "Payment is ok.", "{'sucess':". $success ."}");
        } else {
            $res = $this->httpRes(500, "Payment is NOT ok.", "{'sucess':". $success ."}");
        }
        
        
        return $res;
    }
}
