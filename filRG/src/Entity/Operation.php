<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Compte;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OperationRepository")
 */
class Operation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Date;

    /**
     * @ORM\Column(type="float")
     */
    private $monaant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Partenaire", inversedBy="operations")
     */
    private $partenaire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\compte", inversedBy="operations")
     */
    private $compt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getMonaant(): ?float
    {
        return $this->monaant;
    }

    public function setMonaant(float $monaant): self
    {
        $this->monaant = $monaant;

        return $this;
    }

    public function getPartenaire(): ?Partenaire
    {
        return $this->partenaire;
    }

    public function setPartenaire(?Partenaire $partenaire): self
    {
        $this->partenaire = $partenaire;

        return $this;
    }

    public function getCompt(): ?compte
    {
        return $this->compt;
    }

    public function setCompt(?compte $compt): self
    {
        $this->compt = $compt;

        return $this;
    }
}
