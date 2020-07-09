<?php

namespace App\Entity;

use App\Repository\CampaignRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CampaignRepository::class)
 */
class Campaign
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
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=Lord::class, mappedBy="campaign")
     */
    private $lords;

    public function __construct()
    {
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
            $lord->addCampaign($this);
        }

        return $this;
    }

    public function removeLord(Lord $lord): self
    {
        if ($this->lords->contains($lord)) {
            $this->lords->removeElement($lord);
            $lord->removeCampaign($this);
        }

        return $this;
    }
    
    public function __toString()
    {
        return $this->name;
    }
}
