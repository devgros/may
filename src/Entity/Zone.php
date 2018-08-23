<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ZoneRepository")
 */
class Zone
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Item", inversedBy="zones")
     */
    private $items;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\RayonsMagasin", mappedBy="zones")
     */
    private $rayonsMagasins;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AuditItem", mappedBy="zone", orphanRemoval=true)
     */
    private $auditItems;


    public function __toString()
    {
        return $this->nom;
    }

    public function __construct()
    {
        $this->items = new ArrayCollection();
        $this->rayonsMagasins = new ArrayCollection();
        $this->auditItems = new ArrayCollection();
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

    /**
     * @return Collection|Item[]
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(Item $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $item->addZone($this);
        }

        return $this;
    }

    public function removeItem(Item $item): self
    {
        if ($this->items->contains($item)) {
            $this->items->removeElement($item);
            $item->removeZone($this);
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
            $rayonsMagasin->addZone($this);
        }

        return $this;
    }

    public function removeRayonsMagasin(RayonsMagasin $rayonsMagasin): self
    {
        if ($this->rayonsMagasins->contains($rayonsMagasin)) {
            $this->rayonsMagasins->removeElement($rayonsMagasin);
            $rayonsMagasin->removeZone($this);
        }

        return $this;
    }

    /**
     * @return Collection|AuditItem[]
     */
    public function getAuditItems(): Collection
    {
        return $this->auditItems;
    }

    public function addAuditItem(AuditItem $auditItem): self
    {
        if (!$this->auditItems->contains($auditItem)) {
            $this->auditItems[] = $auditItem;
            $auditItem->setZone($this);
        }

        return $this;
    }

    public function removeAuditItem(AuditItem $auditItem): self
    {
        if ($this->auditItems->contains($auditItem)) {
            $this->auditItems->removeElement($auditItem);
            // set the owning side to null (unless already changed)
            if ($auditItem->getZone() === $this) {
                $auditItem->setZone(null);
            }
        }

        return $this;
    }
}
