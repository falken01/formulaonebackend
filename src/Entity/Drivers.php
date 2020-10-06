<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DriversRepository")
 */
class Drivers
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
    private $Number;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Surname;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nationality;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Team", inversedBy="drivers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Team;


    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Points;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Apperances;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Podiums", mappedBy="driver", cascade={"persist", "remove"})
     */
    private $podiums;

    /**
     * @ORM\Column(type="integer")
     */
    private $PolePositions;




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->Number;
    }

    public function setNumber(int $Number): self
    {
        $this->Number = $Number;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->Surname;
    }

    public function setSurname(string $Surname): self
    {
        $this->Surname = $Surname;

        return $this;
    }


    public function getNationality(): ?string
    {
        return $this->Nationality;
    }

    public function setNationality(string $Nationality): self
    {
        $this->Nationality = $Nationality;

        return $this;
    }

    public function getTeam(): ?Team
    {
        return $this->Team;
    }

    public function setTeam(?Team $Team): self
    {
        $this->Team = $Team;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->Points;
    }

    public function setPoints(?int $Points): self
    {
        $this->Points = $Points;

        return $this;
    }

    public function getApperances(): ?int
    {
        return $this->Apperances;
    }

    public function setApperances(?int $Apperances): self
    {
        $this->Apperances = $Apperances;

        return $this;
    }

    public function getPodiums(): ?Podiums
    {
        return $this->podiums;
    }

    public function setPodiums(Podiums $podiums): self
    {
        $this->podiums = $podiums;

        // set the owning side of the relation if necessary
        if ($podiums->getDriver() !== $this) {
            $podiums->setDriver($this);
        }

        return $this;
    }

    public function getPolePositions(): ?int
    {
        return $this->PolePositions;
    }

    public function setPolePositions(int $PolePositions): self
    {
        $this->PolePositions = $PolePositions;

        return $this;
    }
}
