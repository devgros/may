<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AuditItemRepository")
 */
class AuditItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $statut;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Audit", inversedBy="items" ,cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $audit;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Item", inversedBy="audits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $item;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Zone", inversedBy="auditItems")
     * @ORM\JoinColumn(nullable=false)
     */
    private $zone;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\RayonsMagasin", inversedBy="auditItems")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rayonsMagasin;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $non_conformite;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $action_corrective;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $delai;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $reccurrence;

    public function getId()
    {
        return $this->id;
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

    public function getAudit(): ?Audit
    {
        return $this->audit;
    }

    public function setAudit(?Audit $audit): self
    {
        $this->audit = $audit;

        return $this;
    }

    public function getItem(): ?Item
    {
        return $this->item;
    }

    public function setItem(?Item $item): self
    {
        $this->item = $item;

        return $this;
    }

    public function getZone(): ?Zone
    {
        return $this->zone;
    }

    public function setZone(?Zone $zone): self
    {
        $this->zone = $zone;

        return $this;
    }

    public function getRayonsMagasin(): ?RayonsMagasin
    {
        return $this->rayonsMagasin;
    }

    public function setRayonsMagasin(?RayonsMagasin $rayonsMagasin): self
    {
        $this->rayonsMagasin = $rayonsMagasin;

        return $this;
    }

    public function getNonConformite(): ?string
    {
        return $this->non_conformite;
    }

    public function setNonConformite(?string $non_conformite): self
    {
        $this->non_conformite = $non_conformite;

        return $this;
    }

    public function getActionCorrective(): ?string
    {
        return $this->action_corrective;
    }

    public function setActionCorrective(?string $action_corrective): self
    {
        $this->action_corrective = $action_corrective;

        return $this;
    }

    public function getDelai(): ?\DateTimeInterface
    {
        return $this->delai;
    }

    public function setDelai(?\DateTimeInterface $delai): self
    {
        $this->delai = $delai;

        return $this;
    }

    public function getReccurrence(): ?bool
    {
        return $this->reccurrence;
    }

    public function setReccurrence(?bool $reccurrence): self
    {
        $this->reccurrence = $reccurrence;

        return $this;
    }
}
