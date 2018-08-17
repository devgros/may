<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RayonsMagasinRepository")
 */
class RayonsMagasin
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Magasin", inversedBy="rayonsMagasins")
     * @ORM\JoinColumn(nullable=false)
     */
    private $magasin;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Rayon", inversedBy="rayonsMagasins")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rayon;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Zone", inversedBy="rayonsMagasins")
     * @ORM\JoinTable(name="rayons_magasin_zone")
     */
    private $zones;

    public function __toString()
    {
        $zones = "";
        $first = true;
        foreach($this->zones as $zone){
            if($first){
                $first = false;
            }else{
                $zones .= ", ";
            }
            $zones .= $zone->getNom();
        }
        return $this->rayon->getNom()." (".$zones.")";
    }

    public function __construct()
    {
        $this->zones = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
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

    public function getRayon(): ?Rayon
    {
        return $this->rayon;
    }

    public function setRayon(?Rayon $rayon): self
    {
        $this->rayon = $rayon;

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
}
