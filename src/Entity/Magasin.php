<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MagasinRepository")
 */
class Magasin
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="magasins")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Audit", mappedBy="magasin")
     */
    private $audits;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RayonsMagasin", mappedBy="magasin", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $rayonsMagasins;

    public function __toString()
    {
        return $this->nom;
    }

    public function __construct()
    {
        $this->audits = new ArrayCollection();
        $this->rayonsMagasins = new ArrayCollection();
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

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection|Audit[]
     */
    public function getAudits(): Collection
    {
        return $this->audits;
    }

    public function addAudit(Audit $audit): self
    {
        if (!$this->audits->contains($audit)) {
            $this->audits[] = $audit;
            $audit->setMagasin($this);
        }

        return $this;
    }

    public function removeAudit(Audit $audit): self
    {
        if ($this->audits->contains($audit)) {
            $this->audits->removeElement($audit);
            // set the owning side to null (unless already changed)
            if ($audit->getMagasin() === $this) {
                $audit->setMagasin(null);
            }
        }

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
            $rayonsMagasin->setMagasin($this);
        }

        return $this;
    }

    public function removeRayonsMagasin(RayonsMagasin $rayonsMagasin): self
    {
        if ($this->rayonsMagasins->contains($rayonsMagasin)) {
            $this->rayonsMagasins->removeElement($rayonsMagasin);
            // set the owning side to null (unless already changed)
            if ($rayonsMagasin->getMagasin() === $this) {
                $rayonsMagasin->setMagasin(null);
            }
        }

        return $this;
    }
}
