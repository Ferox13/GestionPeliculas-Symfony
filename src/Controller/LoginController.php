<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // Si el usuario ya está autenticado, redirige a la ruta "app_home"
        if ($this->getUser()) {
            return $this->redirectToRoute('app_home');
        }

        // Obtener el error de autenticación, si lo hay
        $error = $authenticationUtils->getLastAuthenticationError();
        // Obtener el último nombre de usuario ingresado
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    /*TODO Intentar que el logout redirija al home usando esta función */
    /*   #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): Response
    {
        return $this->redirectToRoute('app_home');
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    } */
   
    #[Route(path: '/logout', name: 'app_logout', methods: ['GET'])]
    public function logout(Request $request, TokenStorageInterface $tokenStorage, SessionInterface $session): Response
    {
        // Elimina el token de autenticación
        $tokenStorage->setToken(null);
        // Invalida la sesión
        $session->invalidate();

        // Redirige al home
        return $this->redirectToRoute('app_home');
    }
}
