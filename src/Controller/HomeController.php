<?php

namespace App\Controller;

use App\Repository\PeliculaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class HomeController extends AbstractController
{
    private $peliculaRepository;

    public function __construct(PeliculaRepository $peliculaRepository)
    {
        $this->peliculaRepository = $peliculaRepository;
    }

    #[Route('/home', name: 'app_home')]
    public function index(Request $request): Response
    {
        $titulo = $request->query->get('titulo');
        $director = $request->query->get('director');
        $genero = $request->query->get('genero');
        $duracion = $request->query->get('duracion');
        $valoracion = $request->query->get('valoracion');

        $query = $this->peliculaRepository->createQueryBuilder('p');

        $filtros = [
            'titulo'    => $titulo,
            'director'  => $director,
            'genero'    => $genero,
            'duracion'  => $duracion,
            'valoracion'=> $valoracion,
        ];

        foreach ($filtros as $key => $value) {
            if (!empty($value)) {
                $query->andWhere("p.$key LIKE :$key")
                      ->setParameter($key, '%' . $value . '%');
            }
        }

        $peliculas = $query->getQuery()->getResult();

        $mensaje = null;
        if (empty($peliculas)) {
            $mensaje = 'No hay películas disponibles.';
        }

        return $this->render('home/index.html.twig', [
            'peliculas' => $peliculas,
            'mensaje' => $mensaje,
        ]);
    }
}
