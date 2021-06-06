<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("post:create")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("post:create","listegroupe:create","listegroupe:edit")
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=1000)
     * @Groups("post:create","listegroupe:create","listegroupe:edit")
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="posts")
     * @Groups("post:create","listegroupe:create")
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity=ListCategory::class, mappedBy="post", cascade={"persist", "remove"})
     */
    private $listCategory;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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
            $this->listCategory->setPost(null);
        }

        // set the owning side of the relation if necessary
        if ($listCategory !== null && $listCategory->getPost() !== $this) {
            $listCategory->setPost($this);
        }

        $this->listCategory = $listCategory;

        return $this;
    }
}
