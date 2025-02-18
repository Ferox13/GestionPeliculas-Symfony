<?php

namespace App\Controller;

use App\Entity\Pelicula;
use App\Repository\PeliculaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class EditarPeliculaController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/editar/pelicula/{id}', name: 'editar_pelicula')]

    public function editarPelicula(
        Request $request,
        int $id,
        PeliculaRepository $peliculaRepository,
        EntityManagerInterface $em
    ): Response {
        $pelicula = $peliculaRepository->find($id);
        if (!$pelicula) {
            throw $this->createNotFoundException('La película no existe.');
        }

        if ($request->isMethod('POST')) {
            $pelicula->setTitulo($request->request->get('titulo'));
            $pelicula->setDirector($request->request->get('director'));
            $pelicula->setGenero($request->request->get('genero'));
            $pelicula->setDuracion($request->request->get('duracion'));
            $pelicula->setValoracion($request->request->get('valoracion'));
            $estrenoString = $request->request->get('estreno');
            if (!empty($estrenoString)) {
                $estrenoDate = \DateTime::createFromFormat('Y-m-d', $estrenoString);
                if ($estrenoDate) {
                    $pelicula->setEstreno($estrenoDate);
                }
            }
            
            $pelicula->setPoster($request->request->get('poster'));

            $em->persist($pelicula);
            $em->flush();

            return $this->redirectToRoute('detalle_pelicula', ['id' => $pelicula->getId()]);
        }

        return $this->render('editar_pelicula/index.html.twig', [
            'pelicula' => $pelicula,
        ]);
    }
}
