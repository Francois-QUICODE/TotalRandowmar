<?php

namespace App\Entity;

use App\Repository\LordRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LordRepository::class)
 */
class Lord
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
     * @ORM\ManyToOne(targetEntity=Dlc::class, inversedBy="lords")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dlc;

    /**
     * @ORM\ManyToOne(targetEntity=Race::class, inversedBy="lords")
     * @ORM\JoinColumn(nullable=false)
     */
    private $race;

    /**
     * @ORM\ManyToMany(targetEntity=Campaign::class, inversedBy="lords")
     */
    private $campaign;

    /**
     * @ORM\ManyToMany(targetEntity=Effect::class, inversedBy="lords")
     */
    private $effects;

    /**
     * @ORM\Column(type="text")
     */
    private $portrait;

    /**
     * @ORM\ManyToMany(targetEntity=Unit::class, inversedBy="lords")
     */
    private $startingUnits;

    public function __construct()
    {
        $this->campaign = new ArrayCollection();
        $this->effects = new ArrayCollection();
        $this->startingUnits = new ArrayCollection();
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

    public function getDlc(): ?Dlc
    {
        return $this->dlc;
    }

    public function setDlc(?Dlc $dlc): self
    {
        $this->dlc = $dlc;

        return $this;
    }

    public function getRace(): ?Race
    {
        return $this->race;
    }

    public function setRace(?Race $race): self
    {
        $this->race = $race;

        return $this;
    }

    /**
     * @return Collection|Campaign[]
     */
    public function getCampaign(): Collection
    {
        return $this->campaign;
    }

    public function addCampaign(Campaign $campaign): self
    {
        if (!$this->campaign->contains($campaign)) {
            $this->campaign[] = $campaign;
        }

        return $this;
    }

    public function removeCampaign(Campaign $campaign): self
    {
        if ($this->campaign->contains($campaign)) {
            $this->campaign->removeElement($campaign);
        }

        return $this;
    }

    /**
     * @return Collection|Effect[]
     */
    public function getEffects(): Collection
    {
        return $this->effects;
    }

    public function addEffect(Effect $effect): self
    {
        if (!$this->effects->contains($effect)) {
            $this->effects[] = $effect;
        }

        return $this;
    }

    public function removeEffect(Effect $effect): self
    {
        if ($this->effects->contains($effect)) {
            $this->effects->removeElement($effect);
        }

        return $this;
    }

    public function getPortrait(): ?string
    {
        return $this->portrait;
    }

    public function setPortrait(string $portrait): self
    {
        $this->portrait = $portrait;

        return $this;
    }

    /**
     * @return Collection|Unit[]
     */
    public function getStartingUnits(): Collection
    {
        return $this->startingUnits;
    }

    public function addStartingUnit(Unit $startingUnit): self
    {
        if (!$this->startingUnits->contains($startingUnit)) {
            $this->startingUnits[] = $startingUnit;
        }

        return $this;
    }

    public function removeStartingUnit(Unit $startingUnit): self
    {
        if ($this->startingUnits->contains($startingUnit)) {
            $this->startingUnits->removeElement($startingUnit);
        }

        return $this;
    }
}
