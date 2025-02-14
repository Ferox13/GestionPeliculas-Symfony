<?php

namespace App\Controller;

use App\Repository\PeliculaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    private $peliculaRepository;

    public function __construct(PeliculaRepository $peliculaRepository)
    {
        $this->peliculaRepository = $peliculaRepository;
    }

    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        $peliculas = $this->peliculaRepository->findAll();

        $mensaje = null;
        if (empty($peliculas)) {
            // La lista está vacía, puedes manejarlo como desees
            $mensaje = 'No hay películas disponibles.';
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'peliculas' => $peliculas,
            'mensaje' => $mensaje,
        ]);
    }
}
