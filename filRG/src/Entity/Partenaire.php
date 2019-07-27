<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PartenaireRepository")
 */
class Partenaire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ninea;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $raison_sociale;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="partenaires")
     */
    private $Partenaire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Compte", inversedBy="Compte")
     */
    private $compte;

    public function __construct()
    {
        $this->Partenaire = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNinea(): ?string
    {
        return $this->ninea;
    }

    public function setNinea(string $ninea): self
    {
        $this->ninea = $ninea;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getRaisonSociale(): ?string
    {
        return $this->raison_sociale;
    }

    public function setRaisonSociale(string $raison_sociale): self
    {
        $this->raison_sociale = $raison_sociale;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getPartenaire(): Collection
    {
        return $this->Partenaire;
    }

    public function addPartenaire(User $partenaire): self
    {
        if (!$this->Partenaire->contains($partenaire)) {
            $this->Partenaire[] = $partenaire;
        }

        return $this;
    }

    public function removePartenaire(User $partenaire): self
    {
        if ($this->Partenaire->contains($partenaire)) {
            $this->Partenaire->removeElement($partenaire);
        }

        return $this;
    }

    public function getCompte(): ?Compte
    {
        return $this->compte;
    }

    public function setCompte(?Compte $compte): self
    {
        $this->compte = $compte;

        return $this;
    }
}
