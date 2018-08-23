<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\Criteria;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AuditRepository")
 */
class Audit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $statut;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Magasin", inversedBy="audits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $magasin;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AuditItem", mappedBy="audit", orphanRemoval=true)
     */
    private $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->date->format('d/m/Y')." - ".$this->magasin->getNom();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getStatut(): ?int
    {
        return $this->statut;
    }

    public function setStatut(int $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getMagasin(): ?Magasin
    {
        return $this->magasin;
    }

    public function setMagasin(?Magasin $magasin): self
    {
        $this->magasin = $magasin;

        return $this;
    }

    /**
     * @return Collection|AuditItem[]
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(AuditItem $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $item->setAudit($this);
        }

        return $this;
    }

    public function removeItem(AuditItem $item): self
    {
        if ($this->items->contains($item)) {
            $this->items->removeElement($item);
            // set the owning side to null (unless already changed)
            if ($item->getAudit() === $this) {
                $item->setAudit(null);
            }
        }

        return $this;
    }

    public function getItem($item, $zone, $rayon_magasin)
    {
        $criteria = Criteria::create()
                        ->where(Criteria::expr()->eq("item", $item))
                        ->andWhere(Criteria::expr()->eq("zone", $zone))
                        ->andWhere(Criteria::expr()->eq("rayonsMagasin", $rayon_magasin))
                        ;
        return $this->items->matching($criteria)->first(); 
    }
}
