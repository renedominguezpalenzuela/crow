<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainPageController extends AbstractController
{
    /**
     * @Route("/mainpage", name="main_page")
     */
    public function index()
    {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        //Main Pagesss
        $error=null;
        return $this->render('player_army/index.html.twig', [
            'controller_name' => 'PlayerArmyController', 'error' =>  $error
        ]);
        //return $this->render('main.html.twig', ['controller_name' => 'MainPageController',   ]);
    }
}
