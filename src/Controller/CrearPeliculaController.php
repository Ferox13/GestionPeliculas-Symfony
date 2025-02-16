<?php

namespace App\Controller;

use App\Entity\Pelicula;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class CrearPeliculaController extends AbstractController
{
    #[Route('/crear/pelicula', name: 'crear_pelicula')]
    public function crearPelicula(Request $request, EntityManagerInterface $em): Response
    {
        if ($request->isMethod('POST')) {
            $pelicula = new Pelicula();
            $pelicula->setTitulo($request->request->get('titulo'));
            $pelicula->setDirector($request->request->get('director'));
            $pelicula->setGenero($request->request->get('genero'));
            $pelicula->setDuracion($request->request->get('duracion'));
            $pelicula->setValoracion($request->request->get('valoracion'));
            $estreno = \DateTime::createFromFormat('Y-m-d', $request->request->get('estreno'));
            $pelicula->setEstreno($estreno);
            $pelicula->setPoster($request->request->get('poster'));

            $em->persist($pelicula);
            $em->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('crear_pelicula/index.html.twig', [
        ]);
    }
}
