<?php

namespace App\Entity;

use App\Repository\SousCategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SousCategorieRepository::class)]
class SousCategorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $Nom_souscategorie = null;

    #[ORM\Column(length: 255)]
    private ?string $Image_souscategorie = null;

    #[ORM\Column(length: 255)]
    private ?string $Description_souscategorie = null;

    #[ORM\ManyToOne(inversedBy: 'sousCategories')]
    private ?Categorie $categorie = null;

    /**
     * @var Collection<int, Produit>
     */
    #[ORM\OneToMany(targetEntity: Produit::class, mappedBy: 'souscategorie')]
    private Collection $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomSouscategorie(): ?string
    {
        return $this->Nom_souscategorie;
    }

    public function setNomSouscategorie(string $Nom_souscategorie): static
    {
        $this->Nom_souscategorie = $Nom_souscategorie;

        return $this;
    }

    public function getImageSouscategorie(): ?string
    {
        return $this->Image_souscategorie;
    }

    public function setImageSouscategorie(string $Image_souscategorie): static
    {
        $this->Image_souscategorie = $Image_souscategorie;

        return $this;
    }

    public function getDescriptionSouscategorie(): ?string
    {
        return $this->Description_souscategorie;
    }

    public function setDescriptionSouscategorie(string $Description_souscategorie): static
    {
        $this->Description_souscategorie = $Description_souscategorie;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): static
    {
        if (!$this->produits->contains($produit)) {
            $this->produits->add($produit);
            $produit->setSouscategorie($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): static
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getSouscategorie() === $this) {
                $produit->setSouscategorie(null);
            }
        }

        return $this;
    }
}
