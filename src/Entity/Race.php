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

    public function __construct()
    {
        $this->racialFeatures = new ArrayCollection();
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
}
