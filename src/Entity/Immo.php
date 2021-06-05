<?php

namespace App\Entity;

use App\Repository\ImmoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImmoRepository::class)
 */
class Immo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $surface;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="immos")
     */
    private $category;

    /**
     * @ORM\OneToOne(targetEntity=ListCategory::class, mappedBy="immo", cascade={"persist", "remove"})
     */
    private $listCategory;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSurface(): ?float
    {
        return $this->surface;
    }

    public function setSurface(?float $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getListCategory(): ?ListCategory
    {
        return $this->listCategory;
    }

    public function setListCategory(?ListCategory $listCategory): self
    {
        // unset the owning side of the relation if necessary
        if ($listCategory === null && $this->listCategory !== null) {
            $this->listCategory->setImmo(null);
        }

        // set the owning side of the relation if necessary
        if ($listCategory !== null && $listCategory->getImmo() !== $this) {
            $listCategory->setImmo($this);
        }

        $this->listCategory = $listCategory;

        return $this;
    }
}
