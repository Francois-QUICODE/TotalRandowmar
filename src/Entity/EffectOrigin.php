<?php

namespace App\Entity;

use App\Repository\EffectOriginRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity(repositoryClass=EffectOriginRepository::class)
*/
class EffectOrigin
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
    * @ORM\OneToMany(targetEntity=Effect::class, mappedBy="Type")
    */
    private $effects;
    
    public function __construct()
    {
        $this->effects = new ArrayCollection();
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
            $effect->setOrigin($this);
        }
        
        return $this;
    }
    
    public function removeEffect(Effect $effect): self
    {
        if ($this->effects->contains($effect)) {
            $this->effects->removeElement($effect);
            // set the owning side to null (unless already changed)
            if ($effect->getOrigin() === $this) {
                $effect->setOrigin(null);
            }
        }
        
        return $this;
    }
    
    public function __toString(){
        return $this->getName();
    }
}
