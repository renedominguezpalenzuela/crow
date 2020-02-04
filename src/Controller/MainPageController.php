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

        //Main Page
        return $this->render('main_page/index.html.twig', ['controller_name' => 'MainPageController',
        ]);
    }
}
