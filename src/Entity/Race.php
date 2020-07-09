<?php

namespace App\Entity;

use App\Repository\RaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RaceRepository::class)
 */
class Race
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
     * @ORM\OneToMany(targetEntity=RacialFeature::class, mappedBy="race")
     */
    private $racialFeatures;

    /**
     * @ORM\OneToMany(targetEntity=Lord::class, mappedBy="race")
     */
    private $lords;

    /**
     * @ORM\ManyToMany(targetEntity=Unit::class, inversedBy="races")
     */
    private $units;

    /**
     * @ORM\ManyToOne(targetEntity=Dlc::class, inversedBy="races")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dlc;


    public function __construct()
    {
        $this->racialFeatures = new ArrayCollection();
        $this->heroes = new ArrayCollection();
        $this->lords = new ArrayCollection();
        $this->units = new ArrayCollection();
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

    /**
     * @return Collection|RacialFeature[]
     */
    public function getRacialFeatures(): Collection
    {
        return $this->racialFeatures;
    }

    public function addRacialFeature(RacialFeature $racialFeature): self
    {
        if (!$this->racialFeatures->contains($racialFeature)) {
            $this->racialFeatures[] = $racialFeature;
            $racialFeature->setRace($this);
        }

        return $this;
    }

    public function removeRacialFeature(RacialFeature $racialFeature): self
    {
        if ($this->racialFeatures->contains($racialFeature)) {
            $this->racialFeatures->removeElement($racialFeature);
            // set the owning side to null (unless already changed)
            if ($racialFeature->getRace() === $this) {
                $racialFeature->setRace(null);
            }
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
            $lord->setRace($this);
        }

        return $this;
    }

    public function removeLord(Lord $lord): self
    {
        if ($this->lords->contains($lord)) {
            $this->lords->removeElement($lord);
            // set the owning side to null (unless already changed)
            if ($lord->getRace() === $this) {
                $lord->setRace(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Unit[]
     */
    public function getUnits(): Collection
    {
        return $this->units;
    }

    public function addUnit(Unit $unit): self
    {
        if (!$this->units->contains($unit)) {
            $this->units[] = $unit;
        }

        return $this;
    }

    public function removeUnit(Unit $unit): self
    {
        if ($this->units->contains($unit)) {
            $this->units->removeElement($unit);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getDlc(): ?Dlc
    {
        return $this->dlc;
    }

    public function setDlc(?Dlc $dlc): self
    {
        $this->dlc = $dlc;

        return $this;
    }
}
