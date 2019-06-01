<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StripeTestController extends AbstractController
{
    /**
     * @Route("/stripe/test", name="stripe_test")
     */
    public function index()
    {
        return $this->render('stripe_test/index.html.twig', [
            'controller_name' => 'StripeTestController',
            'page_name' => 'stripe_test'
        ]);
    }
}
