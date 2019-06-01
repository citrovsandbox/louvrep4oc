<?php

namespace App\Services;

class ValidatorService {

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
        $currentDate = date("c");
        $currentTimestamp = strtotime($currentDate);
        $currentddMM = date("d/M", $currentTimestamp);
        $weekDay = date("l", strtotime($date));
        $ddMM = date("d/M", strtotime($date));

        if($weekDay === "Tuesday" || $ddMM === "01/May" || $ddMM === "01/Nov" || $ddMM === "25/Dec" || ($currentddMM !== $ddMM && strtotime($date) < $currentTimestamp)) {
            return true;
        } else {
            return true;
        }
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
}