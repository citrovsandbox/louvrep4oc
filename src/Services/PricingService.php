<?php

namespace App\Services;

class PricingService {

    public function calc ($bookingType, $tickets) {
        $price = 0;
        foreach($tickets as $ticket) {
            $ticketPrice = $this->_calcTicket($bookingType, $ticket);
            $price += $ticketPrice;
        }
        return $price;
    }

    private function _calcTicket ($bookingType, $ticket) {
        $reduction = $ticket["reduction"];
        $birthDate = is_array($ticket["birthDate"]) ? $ticket["birthDate"][0] : $ticket["birthDate"];
        $age = floor((time() - strtotime($birthDate)) / 31556926);
        dump("Into _calcTicket");
        dump($age);

        if($age < 4) {
            return 0;
        }

        if($age < 12) {
            if($bookingType === "half") {
                return 4;
            } else {
                return 8;
            }
        }

        if($age < 60) {
            if($reduction) {
                if($bookingType === "half") {
                    return 5;
                } else {
                    return 10;
                }
            }
            if($bookingType === "half") {
                return 8;
            } else {
                return 16;
            }
        }

        if($age >= 60) {
            if($reduction) {
                if($bookingType === "half") {
                    return 5;
                } else {
                    return 10;
                }
            }
            if($bookingType === "half") {
                return 6;
            } else {
                return 12;
            }
        }
        return 0;
    }
}