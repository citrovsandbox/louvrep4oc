<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PayController extends AbstractController
{
    /**
     * @Route("/pay", name="pay")
     */
    public function index()
    {
        return $this->render('pay/index.html.twig', [
            'controller_name' => 'PayController',
        ]);
    }
}
