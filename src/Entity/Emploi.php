<?php

namespace App\Entity;

use App\Repository\EmploiRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmploiRepository::class)
 */
class Emploi
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
    private $Salaire;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ContractType;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="emplois")
     */
    private $category;

    /**
     * @ORM\OneToOne(targetEntity=ListCategory::class, mappedBy="emploi", cascade={"persist", "remove"})
     */
    private $listCategory;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSalaire(): ?float
    {
        return $this->Salaire;
    }

    public function setSalaire(?float $Salaire): self
    {
        $this->Salaire = $Salaire;

        return $this;
    }

    public function getContractType(): ?string
    {
        return $this->ContractType;
    }

    public function setContractType(?string $ContractType): self
    {
        $this->ContractType = $ContractType;

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
            $this->listCategory->setEmploi(null);
        }

        // set the owning side of the relation if necessary
        if ($listCategory !== null && $listCategory->getEmploi() !== $this) {
            $listCategory->setEmploi($this);
        }

        $this->listCategory = $listCategory;

        return $this;
    }
}
