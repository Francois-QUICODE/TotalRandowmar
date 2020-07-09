<?php

namespace App\Entity;

use App\Repository\DlcRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DlcRepository::class)
 */
class Dlc
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
     * @ORM\ManyToOne(targetEntity=Game::class, inversedBy="dlcs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $game;

    /**
     * @ORM\OneToMany(targetEntity=Lord::class, mappedBy="dlc")
     */
    private $lords;

    /**
     * @ORM\OneToMany(targetEntity=Race::class, mappedBy="dlc")
     */
    private $races;

    public function __construct()
    {
        $this->lords = new ArrayCollection();
        $this->races = new ArrayCollection();
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

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): self
    {
        $this->game = $game;

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
            $lord->setDlc($this);
        }

        return $this;
    }

    public function removeLord(Lord $lord): self
    {
        if ($this->lords->contains($lord)) {
            $this->lords->removeElement($lord);
            // set the owning side to null (unless already changed)
            if ($lord->getDlc() === $this) {
                $lord->setDlc(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
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
            $race->setDlc($this);
        }

        return $this;
    }

    public function removeRace(Race $race): self
    {
        if ($this->races->contains($race)) {
            $this->races->removeElement($race);
            // set the owning side to null (unless already changed)
            if ($race->getDlc() === $this) {
                $race->setDlc(null);
            }
        }

        return $this;
    }
}
