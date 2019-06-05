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

    /**
     * 
     */

namespace App\Services;

// use Doctrine\ORM\EntityManager;

use App\Services\ValidatorService;

class BookingCheckerService {

    private $errors;

    public function __construct (ValidatorService $ValidatorService) {
        $this->errors = [];
        $this->validator = $ValidatorService;
    }

    public function check ($data) {
        if($this->_checkOrder($data["bookingInfo"]) && $this->_checkTickets($data)) {
            return true;
        }
        return false;
    }

    public function getErrors () {
        return $this->errors;
    }

    public function setErrors ($errors) {
        $this->errors = $errors;
    }

    public function addError ($error_as_string) {
        $errors = $this->getErrors();
        array_push($errors, $error_as_string);
        $this->setErrors($errors);
    }


    private function _checkOrder ($bookingInfo) {

        if(isset($bookingInfo["visitorsNumber"])) {
            if(!$this->validator->visitorsNumber($bookingInfo["visitorsNumber"])) {
                $this->addError("Visitors number is incorrect");
            }
        } else {
            $this->addError("You didn't mention a visitors number");
        }


        if(isset($bookingInfo["ticketType"])) {
            if(!$this->validator->ticketType($bookingInfo["ticketType"])) {
                $this->addError("Ticket type is incorrect");
            } else {
                if(isset($bookingInfo["date"]) && $bookingInfo["ticketType"] === "full" && $this->validator->itsTheSameDateDude($bookingInfo["date"]) && $this->itsFourteenTimeOClockBaby()) {
                    $this->addError("You cannot book full day ticket if it's 2pm past.");
                }
            }
        } else {
            $this->addError("You didn't fill a ticket type");
        }

        if(isset($bookingInfo["orderMailing"])) {
            if(!$this->validator->orderMailing($bookingInfo["orderMailing"])) {
                $this->addError("The email you registered for your order is incorrect");
            }
        } else {
            $this->addError("You didn't type any email for your order");
        }

        if(isset($bookingInfo["date"])) {
            if(!$this->validator->bookingDate($bookingInfo["date"])) {
                $this->addError("Your booking date is not available");
            }
        } else {
            $this->addError("You need to fill the booking date");
        }

        if(sizeof($this->getErrors()) > 0) {
            dump($this->getErrors());
            return false;
        } else {
            return true;
        }
    }

    private function _checkTickets ($data) {

        $visitorsNumber = intval($data["bookingInfo"]["visitorsNumber"]);
        $tickets = $data["tickets"];

        if(sizeof($tickets) === $visitorsNumber) {
            // Vérification pour chaque ticket
            foreach($tickets as $key => $ticket) {
                // Que le firstName est conforme
                if(isset($ticket["firstName"])) {
                    if(!$this->validator->varchar255($ticket["firstName"])) {
                        
                        $this->addError("Beneficiary #" . ($key + 1) . ": The first name cannot be longer than 255 characters");
                    }
                } else {
                    dump($key);
                    $this->addError("Beneficiary #" . ($key + 1) . ": No first name");
                }
                // Que le lastName est conforme
                if(isset($ticket["lastName"])) {
                    if(!$this->validator->varchar255($ticket["lastName"])) {
                        $this->addError("Beneficiary #" . ($key + 1) . ": The last name cannot be longer than 255 characters");
                    }
                } else {
                    $this->addError("Beneficiary #" . ($key + 1) . ": No last name");
                }

                // Que la birthDate existe
                if(!isset($ticket["birthDate"])) {
                    $this->addError("Beneficiary #" . ($key + 1) . ": No birth date");
                }

                // Que le country est conforme
                if(isset($ticket["country"])) {
                    if(!$this->validator->varchar255($ticket["country"])) {
                        $this->addError("Beneficiary #" . ($key + 1) . ": The country cannot be longer than 255 characters");
                    }
                } else {
                    $this->addError("Beneficiary #" . ($key + 1) . ": No country");
                }

                // Que le reduction est bien de type bool
                if(isset($ticket["reduction"])) {
                    if(!$this->validator->ticketReduction($ticket["reduction"])) {
                        $this->addError("Beneficiary #" . ($key + 1) . ": The reduction is incorrect");
                    }
                } else {
                    $this->addError("Beneficiary #" . ($key + 1) . ": No reduction");
                }
            }
        } else {
            $this->addError("You registered " . $visitorsNumber . " visitors but you only filled " . sizeof($tickets) . " tickets");
        }

        if(sizeof($this->getErrors()) > 0) {
            dump($this->getErrors());
            return false;
        } else {
            return true;
        }
    }

}