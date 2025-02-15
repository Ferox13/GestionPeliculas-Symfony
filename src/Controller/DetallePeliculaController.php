<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DetallePeliculaController extends AbstractController
{
    #[Route('/detalle/pelicula', name: 'app_detalle_pelicula')]
    public function index(): Response
    {
        return $this->render('detalle_pelicula/index.html.twig', [
        ]);
    }
}
