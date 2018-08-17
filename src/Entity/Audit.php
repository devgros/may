<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
}
