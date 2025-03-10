<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $Nom_produit = null;

    #[ORM\Column(length: 255)]
    private ?string $Description = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2)]
    private ?string $Prix_ht = null;

    #[ORM\Column(length: 255)]
    private ?string $Image_produit = null;

    #[ORM\Column]
    private ?int $Reduction = null;

    #[ORM\Column(length: 50)]
    private ?string $Fournisseur = null;

    #[ORM\Column]
    private ?int $Stock = null;

    #[ORM\Column(length: 50)]
    private ?string $Top_produit = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 2)]
    private ?string $Produit_ttc = null;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    private ?SousCategorie $souscategorie = null;

    /**
     * @var Collection<int, Concerne>
     */
    #[ORM\OneToMany(targetEntity: Concerne::class, mappedBy: 'produit')]
    private Collection $concernes;

    /**
     * @var Collection<int, Contient>
     */
    #[ORM\OneToMany(targetEntity: Contient::class, mappedBy: 'produit')]
    private Collection $contients;

    public function __construct()
    {
        $this->concernes = new ArrayCollection();
        $this->contients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProduit(): ?string
    {
        return $this->Nom_produit;
    }

    public function setNomProduit(string $Nom_produit): static
    {
        $this->Nom_produit = $Nom_produit;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getPrixHt(): ?string
    {
        return $this->Prix_ht;
    }

    public function setPrixHt(string $Prix_ht): static
    {
        $this->Prix_ht = $Prix_ht;

        return $this;
    }

    public function getImageProduit(): ?string
    {
        return $this->Image_produit;
    }

    public function setImageProduit(string $Image_produit): static
    {
        $this->Image_produit = $Image_produit;

        return $this;
    }

    public function getReduction(): ?int
    {
        return $this->Reduction;
    }

    public function setReduction(int $Reduction): static
    {
        $this->Reduction = $Reduction;

        return $this;
    }

    public function getFournisseur(): ?string
    {
        return $this->Fournisseur;
    }

    public function setFournisseur(string $Fournisseur): static
    {
        $this->Fournisseur = $Fournisseur;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->Stock;
    }

    public function setStock(int $Stock): static
    {
        $this->Stock = $Stock;

        return $this;
    }

    public function getTopProduit(): ?string
    {
        return $this->Top_produit;
    }

    public function setTopProduit(string $Top_produit): static
    {
        $this->Top_produit = $Top_produit;

        return $this;
    }

    public function getProduitTtc(): ?string
    {
        return $this->Produit_ttc;
    }

    public function setProduitTtc(string $Produit_ttc): static
    {
        $this->Produit_ttc = $Produit_ttc;

        return $this;
    }

    public function getSouscategorie(): ?SousCategorie
    {
        return $this->souscategorie;
    }

    public function setSouscategorie(?SousCategorie $souscategorie): static
    {
        $this->souscategorie = $souscategorie;

        return $this;
    }

    /**
     * @return Collection<int, Concerne>
     */
    public function getConcernes(): Collection
    {
        return $this->concernes;
    }

    public function addConcerne(Concerne $concerne): static
    {
        if (!$this->concernes->contains($concerne)) {
            $this->concernes->add($concerne);
            $concerne->setProduit($this);
        }

        return $this;
    }

    public function removeConcerne(Concerne $concerne): static
    {
        if ($this->concernes->removeElement($concerne)) {
            // set the owning side to null (unless already changed)
            if ($concerne->getProduit() === $this) {
                $concerne->setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Contient>
     */
    public function getContients(): Collection
    {
        return $this->contients;
    }

    public function addContient(Contient $contient): static
    {
        if (!$this->contients->contains($contient)) {
            $this->contients->add($contient);
            $contient->setProduit($this);
        }

        return $this;
    }

    public function removeContient(Contient $contient): static
    {
        if ($this->contients->removeElement($contient)) {
            // set the owning side to null (unless already changed)
            if ($contient->getProduit() === $this) {
                $contient->setProduit(null);
            }
        }

        return $this;
    }
}
