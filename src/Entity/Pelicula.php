<?php

namespace App\Entity;

use App\Repository\PeliculaRepository;
use DateTime;
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
    private ?float $valoracion = null;

    #[ORM\Column(length: 255)]
    private ?float $duracion = null;

    #[ORM\Column(length: 255)]
    private ?DateTime $estreno = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getDirector(): ?string
    {
        return $this->director;
    }

    public function setDirector(?string $director): self
    {
        $this->director = $director;

        return $this;
    }

    public function getGenero(): ?string
    {
        return $this->genero;
    }

    public function setGenero(string $genero): self
    {
        $this->genero = $genero;

        return $this;
    }

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function setPoster(?string $poster): self
    {
        $this->poster = $poster;

        return $this;
    }

    public function getValoracion(): ?float
    {
        return $this->valoracion;
    }

    public function setValoracion(float $valoracion): self
    {
        $this->valoracion = $valoracion;

        return $this;
    }

    public function getDuracion(): ?float
    {
        return $this->duracion;
    }

    public function setDuracion(float $duracion): self
    {
        $this->duracion = $duracion;

        return $this;
    }

    public function getEstreno(): ?DateTime
    {
        return $this->estreno;
    }

    public function setEstreno(DateTime $estreno): self
    {
        $this->estreno = $estreno;

        return $this;
    }
}
