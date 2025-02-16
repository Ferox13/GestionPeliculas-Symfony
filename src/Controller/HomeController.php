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
        $titulo         = $request->query->get('titulo');
        $director       = $request->query->get('director');
        $genero         = $request->query->get('genero');
        $duracion       = $request->query->get('duracion');
        $valoracion     = $request->query->get('valoracion');
        $estreno        = $request->query->get('estreno');

        $query = $this->peliculaRepository->createQueryBuilder('p');

        $filtros = [
            'titulo'    => $titulo,
            'director'  => $director,
            'genero'    => $genero,
            'duracion'  => $duracion,
            'valoracion'=> $valoracion,
        ];

        // Filtros de tipo cadena o numéricos
        foreach ($filtros as $key => $value) {
            if (!empty($value)) {
                $query->andWhere("p.$key LIKE :$key")
                      ->setParameter($key, '%' . $value . '%');
            }
        }
        error_log("Valor de estreno: " . $estreno);
        dump($estreno);

        // Asegúrate de usar el formato "Y-m-d" para crear el objeto DateTime ya que el input del calendario lo envía en ese formato.
        if (!empty($estreno)) {
            error_log("Valor de estreno: " . $estreno);
            $estrenoDate = \DateTime::createFromFormat('Y-m-d', $estreno);
            if ($estrenoDate) {
                $query->andWhere("p.estreno = :estreno")
                      ->setParameter('estreno', $estrenoDate);
            }
        }

        $peliculas = $query->getQuery()->getResult();

        $mensaje = null;
        if (empty($peliculas)) {
            $mensaje = 'No hay películas disponibles.';
        }

        return $this->render('home/index.html.twig', [
            'peliculas' => $peliculas,
            'mensaje'   => $mensaje,
        ]);
    }

    // Añade un nuevo método para el detalle de la película
    #[Route('/detalle/{id}', name: 'detalle_pelicula')]
    public function detallePelicula(int $id): Response
    {
        $pelicula = $this->peliculaRepository->find($id);
        if (!$pelicula) {
            throw $this->createNotFoundException('La película no existe');
        }

        return $this->render('detalle_pelicula/index.html.twig', [
            'pelicula' => $pelicula,
        ]);
    }
}
