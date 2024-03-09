<?php

namespace App\Entity;

use App\Repository\ProfesoresRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfesoresRepository::class)]
class Profesores
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]


    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $apellido = null;

    // #[ORM\ManyToOne(inversedBy: 'profesores')]
    // #[ORM\JoinColumn(nullable: false)]
    // private ?departamentos $id_departamento = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): static
    {
        $this->apellido = $apellido;

        return $this;
    }

    // public function getIdDepartamento(): ?departamentos
    // {
    //     return $this->id_departamento;
    // }

    // public function setIdDepartamento(?departamentos $id_departamento): static
    // {
    //     $this->id_departamento = $id_departamento;

    //     return $this;
    // }
}
