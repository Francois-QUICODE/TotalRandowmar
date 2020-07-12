<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
class Game
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
    private $Description;


    /**
     * @ORM\OneToMany(targetEntity=Dlc::class, mappedBy="game")
     */
    private $dlcs;

    /**
     * @ORM\OneToMany(targetEntity=Lord::class, mappedBy="game")
     */
    private $lords;

    public function __construct()
    {
        $this->heroes = new ArrayCollection();
        $this->dlcs = new ArrayCollection();
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
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }


    /**
     * @return Collection|Dlc[]
     */
    public function getDlcs(): Collection
    {
        return $this->dlcs;
    }

    public function addDlc(Dlc $dlc): self
    {
        if (!$this->dlcs->contains($dlc)) {
            $this->dlcs[] = $dlc;
            $dlc->setGame($this);
        }

        return $this;
    }

    public function removeDlc(Dlc $dlc): self
    {
        if ($this->dlcs->contains($dlc)) {
            $this->dlcs->removeElement($dlc);
            // set the owning side to null (unless already changed)
            if ($dlc->getGame() === $this) {
                $dlc->setGame(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
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
            $lord->setGame($this);
        }

        return $this;
    }

    public function removeLord(Lord $lord): self
    {
        if ($this->lords->contains($lord)) {
            $this->lords->removeElement($lord);
            // set the owning side to null (unless already changed)
            if ($lord->getGame() === $this) {
                $lord->setGame(null);
            }
        }

        return $this;
    }
}
