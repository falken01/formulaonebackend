<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeamRepository")
 */
class Team
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
    private $NameTeam;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Owner;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $FoundationYear;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Drivers", mappedBy="Team")
     */
    private $drivers;

    public function __construct()
    {
        $this->drivers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameTeam(): ?string
    {
        return $this->NameTeam;
    }

    public function setNameTeam(string $NameTeam): self
    {
        $this->NameTeam = $NameTeam;

        return $this;
    }

    public function getOwner(): ?string
    {
        return $this->Owner;
    }

    public function setOwner(string $Owner): self
    {
        $this->Owner = $Owner;

        return $this;
    }

    public function getFoundationYear(): ?string
    {
        return $this->FoundationYear;
    }

    public function setFoundationYear(string $FoundationYear): self
    {
        $this->FoundationYear = $FoundationYear;

        return $this;
    }

    /**
     * @return Collection|Drivers[]
     */
    public function getDrivers(): Collection
    {
        return $this->drivers;
    }

    public function addDriver(Drivers $driver): self
    {
        if (!$this->drivers->contains($driver)) {
            $this->drivers[] = $driver;
            $driver->setTeam($this);
        }

        return $this;
    }

    public function removeDriver(Drivers $driver): self
    {
        if ($this->drivers->contains($driver)) {
            $this->drivers->removeElement($driver);
            // set the owning side to null (unless already changed)
            if ($driver->getTeam() === $this) {
                $driver->setTeam(null);
            }
        }

        return $this;
    }
}
