<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PodiumsRepository")
 */
class Podiums
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Drivers", inversedBy="podiums", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $driver;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $FirstPlaces;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $SecondPlaces;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ThirdPlaces;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDriver(): ?Drivers
    {
        return $this->driver;
    }

    public function setDriver(Drivers $driver): self
    {
        $this->driver = $driver;

        return $this;
    }

    public function getFirstPlaces(): ?int
    {
        return $this->FirstPlaces;
    }

    public function setFirstPlaces(?int $FirstPlaces): self
    {
        $this->FirstPlaces = $FirstPlaces;

        return $this;
    }

    public function getSecondPlaces(): ?int
    {
        return $this->SecondPlaces;
    }

    public function setSecondPlaces(?int $SecondPlaces): self
    {
        $this->SecondPlaces = $SecondPlaces;

        return $this;
    }

    public function getThirdPlaces(): ?int
    {
        return $this->ThirdPlaces;
    }

    public function setThirdPlaces(?int $ThirdPlaces): self
    {
        $this->ThirdPlaces = $ThirdPlaces;

        return $this;
    }
}
