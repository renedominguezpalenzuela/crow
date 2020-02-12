<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use App\Repository\UserRepository;
use App\Service\CreateInitialUserData;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{
    /**
     * @Route("/usernew", name="user_new")
     */

    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder, LoggerInterface $logger, CreateInitialUserData $datos_iniciales)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            try {
                // 4) save the User!
                $entityManager = $this->getDoctrine()->getManager();

                //Obteniendo el kingdom seleccionado por el usuario
                $kingdom = $form['kingdom']->getData();
                $user->setKingdom($kingdom);

                //Comprobar si existe el nombre de usuario o el email
                $buscar_usuario_userName = $entityManager->getRepository(User::class)->findOneBy(['email' => $user->getUsername()]);
                if ($buscar_usuario_userName != null) {
                    return $this->render('security/register.html.twig', ['error' => 'User name already in use. Select another user name ', 'form' => $form->createView()]);
                }

                //Comprobar si existe el nombre de usuario o el email
                $buscar_usuario_email = $entityManager->getRepository(User::class)->findOneBy(['email' => $user->getEmail()]);
                if ($buscar_usuario_email != null) {
                    return $this->render('security/register.html.twig', ['error' => 'Email already in use. Select another email ', 'form' => $form->createView()]);
                }

                $entityManager->persist($user);
                $entityManager->flush();

               //-----------------------------------------------------
               //  Creando resto de los datos del usuario
               //-----------------------------------------------------
               $datos_iniciales->crear($user);

               $this->addFlash('success', 'Welcome ' . $user->getUsername() . '!');

            } catch (\Error $error) {
                $texto = $error->getMessage();

            }

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            // return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);

            return $this->redirectToRoute('login');
        }

        return $this->render('security/register.html.twig', ['form' => $form->createView(), 'error' => null]);

    }
}
