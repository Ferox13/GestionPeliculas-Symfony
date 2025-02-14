<?php

namespace App\Controller;

use App\Repository\PeliculaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    private $peliculaRepository;

    public function buscarPeliculas(PeliculaRepository $peliculaRepository)
    {
        $this->peliculaRepository = $peliculaRepository;
    }

    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        $peliculas = $this->peliculaRepository->findAll();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'peliculas' => $peliculas,
        ]);
    }
}
