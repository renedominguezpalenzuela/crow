<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class KingdomcourtController extends AbstractController
{
    /**
     * @Route("/kingdomcourt", name="kingdomcourt")
     */
    public function index()
    {
        return $this->render('kingdomcourt/index.html.twig', [
            'controller_name' => 'KingdomcourtController',
        ]);
    }
}
