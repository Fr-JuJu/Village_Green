<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $Nom_categorie = null;

    #[ORM\Column(length: 255)]
    private ?string $Image_categorie = null;

    #[ORM\Column(length: 255)]
    private ?string $Description_categorie = null;

    /**
     * @var Collection<int, SousCategorie>
     */
    #[ORM\OneToMany(targetEntity: SousCategorie::class, mappedBy: 'categorie')]
    private Collection $sousCategories;

    public function __construct()
    {
        $this->sousCategories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCategorie(): ?string
    {
        return $this->Nom_categorie;
    }

    public function setNomCategorie(string $Nom_categorie): static
    {
        $this->Nom_categorie = $Nom_categorie;

        return $this;
    }

    public function getImageCategorie(): ?string
    {
        return $this->Image_categorie;
    }

    public function setImageCategorie(string $Image_categorie): static
    {
        $this->Image_categorie = $Image_categorie;

        return $this;
    }

    public function getDescriptionCategorie(): ?string
    {
        return $this->Description_categorie;
    }

    public function setDescriptionCategorie(string $Description_categorie): static
    {
        $this->Description_categorie = $Description_categorie;

        return $this;
    }

    /**
     * @return Collection<int, SousCategorie>
     */
    public function getSousCategories(): Collection
    {
        return $this->sousCategories;
    }

    public function addSousCategory(SousCategorie $sousCategory): static
    {
        if (!$this->sousCategories->contains($sousCategory)) {
            $this->sousCategories->add($sousCategory);
            $sousCategory->setCategorie($this);
        }

        return $this;
    }

    public function removeSousCategory(SousCategorie $sousCategory): static
    {
        if ($this->sousCategories->removeElement($sousCategory)) {
            // set the owning side to null (unless already changed)
            if ($sousCategory->getCategorie() === $this) {
                $sousCategory->setCategorie(null);
            }
        }

        return $this;
    }
}
