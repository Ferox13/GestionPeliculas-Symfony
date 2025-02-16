<?php

namespace App\Controller;

use App\Entity\Pelicula;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class EliminarPeliculaController extends AbstractController
{
    #[Route('/eliminar/pelicula/{id}', name: 'eliminar_pelicula', methods: ['POST'])]
    public function eliminarPelicula(int $id, EntityManagerInterface $em): Response
    {
        $pelicula = $em->getRepository(Pelicula::class)->find($id);
        if (!$pelicula) {
            throw $this->createNotFoundException('La película no existe.');
        }

        $em->remove($pelicula);
        $em->flush();

        return $this->redirectToRoute('app_home');
    }
}
