<?php

namespace App\Controller;

use App\Repository\PeliculaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class DetallePeliculaController extends AbstractController
{
    #[Route('/detalle/pelicula/{id}', name: 'detalle_pelicula')]
    public function index(int $id, PeliculaRepository $peliculaRepository): Response
    {
        $pelicula = $peliculaRepository->find($id);
        if (!$pelicula) {
            throw $this->createNotFoundException('La película no existe.');
        }

        return $this->render('detalle_pelicula/index.html.twig', [
            'pelicula' => $pelicula,
        ]);
    }
}
