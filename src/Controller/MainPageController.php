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
        return $this->render('main.html.twig', ['controller_name' => 'MainPageController',
        ]);
    }
}
