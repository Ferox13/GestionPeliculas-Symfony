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
        dump($estreno);

        if (!empty($estreno)) {
            $estrenoDate = \DateTime::createFromFormat('Y-m-d', $estreno);
            if ($estrenoDate) {
                $fechaCompleta = $estrenoDate->format('Y-m-d H:i:s');
                //Asigna el primer elemento del array a fechaSInHora
                list($fechaSinHora,) = explode(' ', $fechaCompleta);
                // Usamos LIKE para buscar todas las entradas que empiecen por la fecha filtrada.
                $query->andWhere("p.estreno LIKE :estreno")
                      ->setParameter('estreno', $fechaSinHora . '%');
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
