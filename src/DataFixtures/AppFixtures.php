<?php

namespace App\DataFixtures;

use App\Entity\Booking;
use App\Entity\Ticket;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;

class AppFixtures extends Fixture {

    public function __construct (EntityManagerInterface $EntityManagerInterface) {
        $this->entityManager = $EntityManagerInterface;
    }

    public function load(ObjectManager $manager) {

        $repository = $this->entityManager->getRepository(Booking::class);
        $Booking = $repository->findOneByReference("JBII36G5L91Z0QP9FHQS");


        for ($i = 0; $i < 20; $i++) {
            $Ticket = new Ticket();
            // $Ticket->setReference($this->_buildReference());
            $Ticket->setFirstName($this->_randomFirstName());
            $Ticket->setLastName($this->_randomLastName());
            $Ticket->setBirthDate($this->_randomDateInRange(new \DateTime('1934-01-01'), new \DateTime('2004-12-31')));
            $Ticket->setCountry($this->_randomCountry());
            $Ticket->setReduced($this->_randomReduced());
            $Ticket->setBooking($Booking);

            $manager->persist($Ticket);
        }

        $manager->flush();
    }

    private function _buildReference () {
        $characters = '0123456789aABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < 100; $i++) {
            $randstring = $characters[rand(0, strlen($characters))];
        }
        return $randstring;
    }

    private function _randomLastName () {
        $last_names = array('THABUID', 'GONTRAND', 'FITZGERALD', 'SCHMITT', 'KHETECHYAN', 'MALKI', 'RAMAZAN', 'ARGOURD', 'HARCOURT', 'MASSOTTI', 'LEPLET', 'DESPRES',
        'SOUKAIN', 'KAHBES', 'DUPONT', 'DOE', 'ROSTAIN', 'MARTIN', 'FERNAND', 'LEFEBVRE', 'MOREL', 'PETIT', 'LEGRAND', 'GARNIER', 'FAURE', 'ROUSSEAU', 'BLANC', 'BOYER', 'NGUYEN',
        'JOLY', 'DUVAL', 'DENIS'
        );
        return $last_names[rand ( 0 , count($last_names) -1)];
    }

    private function _randomFirstName () {
        $first_names = array('Juan','Luis','Pedro','Victor', 'John', 'Patrick', 'Mickaël', 'Sébastien', 'Michel', 'Tom', 'Pierre', 'Julien', 'Thomas', 'Henri', 'Augustin', 'Léon', 'Fabrice', 'Fred',
        'Cassiopée', 'Leila', 'Cassandra', 'Fabricia', 'Paloma', 'Adélaïde', 'Marie', 'Claire', 'Elsa', 'Léa', 'Laura', 'Colette', 'Angèle', 'Adèle', 'Roméo'
        );
        return $first_names[rand ( 0 , count($first_names) -1)];
    }

    private function _randomCountry () {
        $countries = array('Allemagne', 'Angleterre', 'Irlande', 'Irlande du Nord', 'Ecosse', 'France', 'Portugal', 'Espagne', 'Italie',
        'Suisse', 'Luxembourg', 'Belgique', 'Pays-Bas', 'Dannemark', 'Autriche', 'Croatie', 'Bosnie-Herzégovine', 'Serbie', 'Monténégro',
        'Grèce', 'Suède', 'Finlande', 'Islande', 'Etats-Unis', 'Australie', 'Nouvelle-Zelande', 'Canada', 'Ukraine', 'Russie'
        );
        return $countries[rand ( 0 , count($countries) -1)];
    }

    private function _randomReduced () {
        $nb = mt_rand(0, 100);

        if($nb > 80) {
            return true;
        }
        return false;
    }

    private function _randomDateInRange(\DateTime $start, \DateTime $end) {
        $randomTimestamp = mt_rand($start->getTimestamp(), $end->getTimestamp());
        $randomDate = new \DateTime();
        $randomDate->setTimestamp($randomTimestamp);
        return $randomDate;
    }

}
