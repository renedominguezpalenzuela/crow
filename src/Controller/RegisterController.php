<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\User;
use App\Form\UserType;
//use App\Repository\UserRepository;
//use App\Service\CreateInitialUserData;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Psr\Log\LoggerInterface;

class RegisterController extends AbstractController
{
    /**
     * @Route("/usernew", name="user_new")
     */

    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder, LoggerInterface $logger)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user); 

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
/*
        $logger->critical('FORMULARIO ', [
            // include extra "context" info in your logs
            'cause' => $form,
        ]);*/


        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);

            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('login');
        }

        return $this->render('security/register.html.twig',  ['form' => $form->createView()] );

       
    }
}
