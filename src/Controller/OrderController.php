<?php

namespace App\Controller;

use App\Controller\BaseController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

use App\Entity\Booking;
use App\Entity\Ticket;


use App\Services\BookingChecker;

class OrderController extends BaseController
{
    /**
     * @Route("/order", name="order", methods={"POST"})
     */
    public function index(Request $request, BookingChecker $BookingChecker)
    {
        $data = $this->getPostBody($request);
        if($BookingChecker->check($data)) {

            // $NewBooking = new Booking();
            // $NewBooking->setReference('XXXXXXXXXXXXXXXXXXXX');
            // $NewBooking->setType($data["bookingInfo"]["ticketType"]);
            // $NewBooking->setVisitDate($data["bookingInfo"]["visitDate"]);
            // $NewBooking->setVisitorsNumber($data["bookingInfo"]["visitorsNumber"]);
            // $NewBooking->setPurchaserEmail($data["bookingInfo"]["orderMailing"]);

            // $this->getDoctrine()->getManager()->persist($NewBooking);

            // $this->flush();
            $res = $this->httpRes(200, json_encode($data, true), "{}");

        } else {
            $res = $this->httpRes(500, "An error occured. Please try again by restarting the form.", "{}");
        }
        
        return $res;
    }
}
