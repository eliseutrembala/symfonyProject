<?php

namespace App\Entity;

use App\Repository\CarroRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarroRepository::class)]
class Carro
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $marca = null;

    #[ORM\Column(length: 255)]
    private ?string $modelo = null;

    #[ORM\Column]
    private ?int $ano = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cor = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarca(): ?string
    {
        return $this->marca;
    }

    public function setMarca(string $marca): static
    {
        $this->marca = $marca;

        return $this;
    }

    public function getModelo(): ?string
    {
        return $this->modelo;
    }

    public function setModelo(string $modelo): static
    {
        $this->modelo = $modelo;

        return $this;
    }

    public function getAno(): ?int
    {
        return $this->ano;
    }

    public function setAno(int $ano): static
    {
        $this->ano = $ano;

        return $this;
    }

    public function getCor(): ?string
    {
        return $this->cor;
    }

    public function setCor(?string $cor): static
    {
        $this->cor = $cor;

        return $this;
    }
}
