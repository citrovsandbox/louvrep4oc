<?php

namespace App\Services;

use App\Services\LouvreService;
use App\Entity\Booking;
use Doctrine\ORM\EntityManagerInterface;


class ValidatorService {
    
    public function __construct (EntityManagerInterface $EntityManagerInterface) {
        $this->entityManager = $EntityManagerInterface;
    }

    /**
     * Vérification du nombre de visiteurs
     * On ne peut pas fournir un nombre de visiteur inférieur ou égal à zéro
     */
    public function visitorsNumber ($visitorsNumber) {
        if($visitorsNumber > 0) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Vérification que le type de ticket est bien soit half soit full
     */
    public function ticketType ($ticketType) {
        if($ticketType === "half" || $ticketType === "full") {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Vérification de si l'email de l'utilisateur est valide ou pas
     */
    public function orderMailing($mail) {
        if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Le musée est ouvert tous les jours sauf le Mardi, 
     * le 1er Mai, le 1er Novembre et le 25 décembre
     * 
     * cf: https://openclassrooms.com/fr/projects/35/assignment
     */
    public function bookingDate ($date) {
        $state = true;

        $currentDate = date("c");
        $currentTimestamp = strtotime($currentDate);
        $currentddMM = date("d/M", $currentTimestamp);
        $weekDay = date("l", strtotime($date));
        $ddMM = date("d/M", strtotime($date));
        $dateIsEnabled = $this->dateIsEnabled($date);

        if($weekDay === "Tuesday" || $weekDay === "Sunday" || $ddMM === "01/May" || $ddMM === "01/Nov" || $ddMM === "25/Dec" || $ddMM === "14/Jul" || $ddMM === "08/May" || $ddMM === "11/Nov" || $ddMM === "01/Jan" ||  ($currentddMM !== $ddMM && strtotime($date) < $currentTimestamp)) {
            $state = false;
        }
        if($dateIsEnabled === false) {
            $state = false;
        }

        return $state;
    }
    /**
     * Petit méthode pour check que ça va rentrer dans du varchar 255
     */
    public function varchar255($string) {
        if(strlen($string) > 255) {
            return false;
        } else {
            return true;
        }
    }
    /**
     * Vérification que réduction est un booléen et pas du n'importe quoi
     */
    public function ticketReduction ($reduction) {
        if(is_bool($reduction)) {
            return true;
        } else {
            return false;
        }
    }

    public function dateIsEnabled ($date) {

        $repository = $this->entityManager->getRepository(Booking::class);
        $Bookings = $repository->findByVisitDate(new \DateTime($date));
        $nb = count($Bookings);

        if($nb >= 1000) {
            $dateIsEnabled = false;
        } else {
            $dateIsEnabled = true;
        }
        return $dateIsEnabled;
    }

    public function itsTheSameDateDude ($date_as_string) {
        $currentDate = date("c");
        $currentTimestamp = strtotime($currentDate);
        $currentddMM = date("d/M", $currentTimestamp);
        $ddMM = date("d/M", strtotime($date_as_string));
        
        if($ddMM === $currentddMM) {
            return true;
        } else {
            return false;
        }
    }

    public function itsFourteenTimeOClockBaby () {
        $tz = 'Europe/Paris';
        $date_time = new DateTime("now", new DateTimeZone($tz));
        $hour = $date_time->format('H');

        if ($hour >= 14) {
            return true;
        } else {
            return false;
        }
    }
}