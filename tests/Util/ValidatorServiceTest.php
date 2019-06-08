<?php

namespace App\Tests\Util;

use App\Entity\Booking;
use Doctrine\ORM\EntityManagerInterface;
use App\Services\ValidatorService;
use PHPUnit\Framework\TestCase;

class ValidatorServiceTest extends TestCase {

    /**
     * La règle est la suivante :
     * Si l'utilisateur renseigne un nombre <= 0 pour le nombre de visiteurs, alors
     * cela doit retourner false car il n'est pas possible de réserver pour moins d'un
     * visiteur.
     */
    public function testVisitorsNumber () {

        $entityManager = $this->createMock(EntityManagerInterface::class);
        $ValidatorService = new ValidatorService($entityManager);
        $result = $ValidatorService->visitorsNumber(0);
        $this->assertEquals(false, $result);

    }
    /**
     * Test de notre validateur qui vérifie si un mail est correct ou pas afin que l'utilisateur
     * ne renseigne pas un faux email ce qui, de facto, l'empêcherait de recevoir ses
     * billets.
     * Dans notre ce test unitaire j'ai pris comme exemple la faute de frappe classique où
     * l'utilisateur manque la combinaison [Alt Gr] + [à] afin de faire le '@' sur son clavier. S'il
     * ne s'en rend pas compte, il risquerait de fournir un email erroné et donc, de ne jamais recevoir
     * ses billets.
     */
    public function testOrderMailing () {
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $ValidatorService = new ValidatorService($entityManager);
        $result = $ValidatorService->orderMailing("vmm1996àgmail.com");
        $this->assertEquals(false, $result);

    }
    /**
     * Les données provenenant du client, elles ont pu être modifiées. Il faut donc s'en méfier.
     * Par convention, et pour la suite des traitements, la donnée qui revient depuis le formulaire
     * pour le type de billet (demi-journée/journée pleine) doit être soit {String} "half" || "full"
     * Tout autre {String} doit être rejeté.
     * 
     */
    public function testTicketType () {
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $ValidatorService = new ValidatorService($entityManager);
        $result = $ValidatorService->ticketType("full");
        $this->assertEquals(true, $result);
    }
    /**
     * La réduction doit toujours être de type booléen
     */
    public function testTicketReduction () {
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $ValidatorService = new ValidatorService($entityManager);
        $result = $ValidatorService->ticketReduction(true);
        $this->assertEquals(true, $result);
    }
}