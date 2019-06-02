<?php

namespace App\Services;

class PaymentService {

    public function makeTransaction ($public_token, $Booking ) {
        try {
            \Stripe\Stripe::setApiKey("sk_test_xWJBmr6VQPy0rBB2LRFfFUia00lqfnoclU");
            $charge = \Stripe\Charge::create(array(
                "amount" => $Booking->getPrice() * 100, // prix * en centimes
                "currency" => "eur",
                "source" => $public_token,
                "description" => "Commande effectuée via la boutique"
            ));
            return true;
        } catch(\Stripe\Error\Card $e) {
            return false;
        }
    }

}