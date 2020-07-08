<?php

namespace App\Entity;

use App\Repository\UnitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UnitRepository::class)
 */
class Unit
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
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=Race::class, mappedBy="units")
     */
    private $races;

    /**
     * @ORM\ManyToMany(targetEntity=Lord::class, mappedBy="startingUnits")
     */
    private $lords;

    public function __construct()
    {
        $this->races = new ArrayCollection();
        $this->lords = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Race[]
     */
    public function getRaces(): Collection
    {
        return $this->races;
    }

    public function addRace(Race $race): self
    {
        if (!$this->races->contains($race)) {
            $this->races[] = $race;
            $race->addUnit($this);
        }

        return $this;
    }

    public function removeRace(Race $race): self
    {
        if ($this->races->contains($race)) {
            $this->races->removeElement($race);
            $race->removeUnit($this);
        }

        return $this;
    }

    /**
     * @return Collection|Lord[]
     */
    public function getLords(): Collection
    {
        return $this->lords;
    }

    public function addLord(Lord $lord): self
    {
        if (!$this->lords->contains($lord)) {
            $this->lords[] = $lord;
            $lord->addStartingUnit($this);
        }

        return $this;
    }

    public function removeLord(Lord $lord): self
    {
        if ($this->lords->contains($lord)) {
            $this->lords->removeElement($lord);
            $lord->removeStartingUnit($this);
        }

        return $this;
    }
}
