<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CrearPeliculaController extends AbstractController
{
    #[Route('/crear/pelicula', name: 'app_crear_pelicula')]
    public function index(): Response
    {
        return $this->render('crear_pelicula/index.html.twig', [
            'controller_name' => 'CrearPeliculaController',
        ]);
    }
}
