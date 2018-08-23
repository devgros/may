<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ItemRepository")
 */
class Item
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $text_non_conformite;

    /**
     * @ORM\Column(type="smallint")
     */
    private $categorie;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Zone", mappedBy="items")
     */
    private $zones;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AuditItem", mappedBy="item", orphanRemoval=true)
     */
    private $audits;

    public function __toString()
    {
        return $this->nom;
    }

    public function __construct()
    {
        $this->zones = new ArrayCollection();
        $this->audits = new ArrayCollection();
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

    public function getTextNonConformite(): ?string
    {
        return $this->text_non_conformite;
    }

    public function setTextNonConformite(?string $text_non_conformite): self
    {
        $this->text_non_conformite = $text_non_conformite;

        return $this;
    }

    public function getCategorie(): ?int
    {
        return $this->categorie;
    }

    public function setCategorie(int $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection|Zone[]
     */
    public function getZones(): Collection
    {
        return $this->zones;
    }

    public function addZone(Zone $zone): self
    {
        if (!$this->zones->contains($zone)) {
            $this->zones[] = $zone;
        }

        return $this;
    }

    public function removeZone(Zone $zone): self
    {
        if ($this->zones->contains($zone)) {
            $this->zones->removeElement($zone);
        }

        return $this;
    }

    /**
     * @return Collection|AuditItem[]
     */
    public function getAudits(): Collection
    {
        return $this->audits;
    }

    public function addAudit(AuditItem $audit): self
    {
        if (!$this->audits->contains($audit)) {
            $this->audits[] = $audit;
            $audit->setItem($this);
        }

        return $this;
    }

    public function removeAudit(AuditItem $audit): self
    {
        if ($this->audits->contains($audit)) {
            $this->audits->removeElement($audit);
            // set the owning side to null (unless already changed)
            if ($audit->getItem() === $this) {
                $audit->setItem(null);
            }
        }

        return $this;
    }
}
