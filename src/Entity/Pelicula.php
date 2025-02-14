<?php

namespace App\Entity;

use App\Repository\PeliculaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PeliculaRepository::class)]
class Pelicula
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titulo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $director = null;

    #[ORM\Column(length: 255)]
    private ?string $genero = null;

    #[ORM\Column(length: 350, nullable: true)]
    private ?string $poster = null;

    #[ORM\Column(length: 255)]
    private ?string $valoracion = null;

    #[ORM\Column(length: 255)]
    private ?string $duracion = null;

    #[ORM\Column(length: 255)]
    private ?string $estreno = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): static
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getDirector(): ?string
    {
        return $this->director;
    }

    public function setDirector(?string $director): static
    {
        $this->director = $director;

        return $this;
    }

    public function getGenero(): ?string
    {
        return $this->genero;
    }

    public function setGenero(string $genero): static
    {
        $this->genero = $genero;

        return $this;
    }

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function setPoster(?string $poster): static
    {
        $this->poster = $poster;

        return $this;
    }

    public function getValoracion(): ?string
    {
        return $this->valoracion;
    }

    public function setValoracion(string $valoracion): static
    {
        $this->valoracion = $valoracion;

        return $this;
    }

    public function getDuracion(): ?string
    {
        return $this->duracion;
    }

    public function setDuracion(string $duracion): static
    {
        $this->duracion = $duracion;

        return $this;
    }

    public function getEstreno(): ?string
    {
        return $this->estreno;
    }

    public function setEstreno(string $estreno): static
    {
        $this->estreno = $estreno;

        return $this;
    }
}
