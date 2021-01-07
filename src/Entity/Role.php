<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoleRepository::class)
 */
class Role
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $libelle;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="lesRoles")
     * @ORM\JoinTable(
     *        name="administration",
     *        joinColumns={@ORM\JoinColumn(name="idrole", referencedColumnName="id")},
     *        inverseJoinColumns={@ORM\JoinColumn(name="iduser", referencedColumnName="id")}
     *        )
     */
    private $lesUsers;

    public function __construct()
    {
        $this->lesUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getLesUsers(): Collection
    {
        return $this->lesUsers;
    }

    public function addLesUser(User $lesUser): self
    {
        if (!$this->lesUsers->contains($lesUser)) {
            $this->lesUsers[] = $lesUser;
        }

        return $this;
    }

    public function removeLesUser(User $lesUser): self
    {
        $this->lesUsers->removeElement($lesUser);

        return $this;
    }
}
