<?php

namespace App\Entity;

use App\Repository\ListCategoryRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ListCategoryRepository::class)
 */
class ListCategory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Post::class, inversedBy="listCategory", cascade={"persist", "remove"})
     * @Groups("listegroupe:create","listegroupe:edit")
     */
    private $post;

    /**
     * @ORM\OneToOne(targetEntity=Emploi::class, inversedBy="listCategory", cascade={"persist", "remove"})
     * @Groups("listegroupe:create","listegroupe:edit")
     */
    private $emploi;

    /**
     * @ORM\OneToOne(targetEntity=Immo::class, inversedBy="listCategory", cascade={"persist", "remove"})
     * @Groups("listegroupe:create","listegroupe:edit")
     */
    private $immo;

    /**
     * @ORM\OneToOne(targetEntity=Automobile::class, cascade={"persist", "remove"})
     * @Groups("listegroupe:create","listegroupe:edit")
     */
    private $automobile;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): self
    {
        $this->post = $post;

        return $this;
    }

    public function getEmploi(): ?Emploi
    {
        return $this->emploi;
    }

    public function setEmploi(?Emploi $emploi): self
    {
        $this->emploi = $emploi;

        return $this;
    }

    public function getImmo(): ?Immo
    {
        return $this->immo;
    }

    public function setImmo(?Immo $immo): self
    {
        $this->immo = $immo;

        return $this;
    }

    public function getAutomobile(): ?Automobile
    {
        return $this->automobile;
    }

    public function setAutomobile(?Automobile $automobile): self
    {
        $this->automobile = $automobile;

        return $this;
    }
}
