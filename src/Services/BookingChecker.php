<?php
// bookingInfo
    // date: Sat Jun 01 2019 22:05:00 GMT+0200 (heure d’été d’Europe centrale) {}
    // orderMailing: "vmm1996@gmail.com"
    // orderMailingConfirm: "vmm1996@gmail.com"
    // ticketType: "full"
    // visitorsNumber: 3
// tickets:
    // (1)
    // birthDate: [Wed Oct 18 1995 22:05:00 GMT+0100 (heure normale d’Europe centrale)]
    // country: "France"
    // firstName: "Camille"
    // lastName: "DESPRES"
    // reduction: true


namespace App\Services;

// use Doctrine\ORM\EntityManager;

class BookingChecker {

    public $errors;

    public function check ($data) {
        dump($data);
        return true;
    }

}