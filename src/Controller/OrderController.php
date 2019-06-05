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
use App\Entity\Ticket;


use App\Services\BookingCheckerService;
use App\Services\PricingService;

class OrderController extends BaseController
{
    public function __construct (BookingCheckerService $BookingChecker, PricingService $PricingService) {
        $this->bookingCheckerService = $BookingChecker;
        $this->pricingService = $PricingService;
    }
    /**
     * @Route("/order", name="order", methods={"POST"})
     */
    public function index(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        if($this->bookingCheckerService->check($data)) {
            $Manager = $this->getDoctrine()->getManager();
            $BookingRepo = 
            $bookingInfo = $data["bookingInfo"];
            $tickets = $data["tickets"];

            $Booking = new Booking ();
            $Booking->setType($bookingInfo["ticketType"]);
            $Booking->setVisitDate(new \DateTime($bookingInfo["date"]));
            $Booking->setVisitorsNumber($bookingInfo["visitorsNumber"]);
            $Booking->setPurchaserEmail($bookingInfo["orderMailing"]);
            $Booking->setPrice($this->pricingService->calc($Booking->getType(), $tickets));
            $Manager->persist($Booking);
            
            $Manager->flush();


            foreach($tickets as $ticket) {
                $birthDate = is_array($ticket["birthDate"]) ? $ticket["birthDate"][0] : $ticket["birthDate"];
                $Ticket = new Ticket();
                $Ticket->setBooking($Booking);
                $Ticket->setFirstName($ticket["firstName"]);
                $Ticket->setLastName($ticket["lastName"]);
                dump($ticket["birthDate"]);
                $Ticket->setBirthDate(new \DateTime($birthDate));
                $Ticket->setCountry($ticket["country"]);
                $Ticket->setReduced($ticket["reduction"]);
                $Manager->persist($Ticket);
            }

            $Manager->flush();

            $res = $this->httpRes(200, "Order registered. You can now pay safely.", '{"bookingReference":"'. $Booking->getReference() .'", "totalPrice":'. $Booking->getPrice() .'}');

        } else {
            $res = $this->httpRes(403, "The booking is not totally OK.", json_encode($this->bookingCheckerService->getErrors()));
            
        }
        return $res;
    }
}
