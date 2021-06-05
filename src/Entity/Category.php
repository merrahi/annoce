<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Emploi::class, mappedBy="category")
     */
    private $emplois;

    /**
     * @ORM\OneToMany(targetEntity=Automobile::class, mappedBy="category")
     */
    private $automobiles;

    /**
     * @ORM\OneToMany(targetEntity=Immo::class, mappedBy="category")
     */
    private $immos;


    public function __construct()
    {
        $this->emplois = new ArrayCollection();
        $this->automobiles = new ArrayCollection();
        $this->immos = new ArrayCollection();
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
     * @return Collection|Emploi[]
     */
    public function getEmplois(): Collection
    {
        return $this->emplois;
    }

    public function addEmploi(Emploi $emploi): self
    {
        if (!$this->emplois->contains($emploi)) {
            $this->emplois[] = $emploi;
            $emploi->setCategory($this);
        }

        return $this;
    }

    public function removeEmploi(Emploi $emploi): self
    {
        if ($this->emplois->removeElement($emploi)) {
            // set the owning side to null (unless already changed)
            if ($emploi->getCategory() === $this) {
                $emploi->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Automobile[]
     */
    public function getAutomobiles(): Collection
    {
        return $this->automobiles;
    }

    public function addAutomobile(Automobile $automobile): self
    {
        if (!$this->automobiles->contains($automobile)) {
            $this->automobiles[] = $automobile;
            $automobile->setCategory($this);
        }

        return $this;
    }

    public function removeAutomobile(Automobile $automobile): self
    {
        if ($this->automobiles->removeElement($automobile)) {
            // set the owning side to null (unless already changed)
            if ($automobile->getCategory() === $this) {
                $automobile->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Immo[]
     */
    public function getImmos(): Collection
    {
        return $this->immos;
    }

    public function addImmo(Immo $immo): self
    {
        if (!$this->immos->contains($immo)) {
            $this->immos[] = $immo;
            $immo->setCategory($this);
        }

        return $this;
    }

    public function removeImmo(Immo $immo): self
    {
        if ($this->immos->removeElement($immo)) {
            // set the owning side to null (unless already changed)
            if ($immo->getCategory() === $this) {
                $immo->setCategory(null);
            }
        }

        return $this;
    }

}
