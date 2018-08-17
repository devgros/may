<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RayonRepository")
 */
class Rayon
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $couleur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RayonsMagasin", mappedBy="rayon", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $rayonsMagasins;

    public function __construct()
    {
        $this->rayonsMagasins = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nom;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * @return Collection|RayonsMagasin[]
     */
    public function getRayonsMagasins(): Collection
    {
        return $this->rayonsMagasins;
    }

    public function addRayonsMagasin(RayonsMagasin $rayonsMagasin): self
    {
        if (!$this->rayonsMagasins->contains($rayonsMagasin)) {
            $this->rayonsMagasins[] = $rayonsMagasin;
            $rayonsMagasin->setRayon($this);
        }

        return $this;
    }

    public function removeRayonsMagasin(RayonsMagasin $rayonsMagasin): self
    {
        if ($this->rayonsMagasins->contains($rayonsMagasin)) {
            $this->rayonsMagasins->removeElement($rayonsMagasin);
            // set the owning side to null (unless already changed)
            if ($rayonsMagasin->getRayon() === $this) {
                $rayonsMagasin->setRayon(null);
            }
        }

        return $this;
    }

}
