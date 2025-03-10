<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Date_commande = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 2)]
    private ?string $Montant_total = null;

    #[ORM\Column(length: 255)]
    private ?string $Facture = null;

    #[ORM\Column(length: 50)]
    private ?string $Moyen_paiement = null;

    #[ORM\Column(length: 255)]
    private ?string $Bon_commande = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Date_facturation = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    private ?Utilisateur $utilisateur = null;

    /**
     * @var Collection<int, Livraison>
     */
    #[ORM\OneToMany(targetEntity: Livraison::class, mappedBy: 'commande')]
    private Collection $livraisons;

    /**
     * @var Collection<int, Concerne>
     */
    #[ORM\OneToMany(targetEntity: Concerne::class, mappedBy: 'commande')]
    private Collection $concernes;

    public function __construct()
    {
        $this->livraisons = new ArrayCollection();
        $this->concernes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->Date_commande;
    }

    public function setDateCommande(\DateTimeInterface $Date_commande): static
    {
        $this->Date_commande = $Date_commande;

        return $this;
    }

    public function getMontantTotal(): ?string
    {
        return $this->Montant_total;
    }

    public function setMontantTotal(string $Montant_total): static
    {
        $this->Montant_total = $Montant_total;

        return $this;
    }

    public function getFacture(): ?string
    {
        return $this->Facture;
    }

    public function setFacture(string $Facture): static
    {
        $this->Facture = $Facture;

        return $this;
    }

    public function getMoyenPaiement(): ?string
    {
        return $this->Moyen_paiement;
    }

    public function setMoyenPaiement(string $Moyen_paiement): static
    {
        $this->Moyen_paiement = $Moyen_paiement;

        return $this;
    }

    public function getBonCommande(): ?string
    {
        return $this->Bon_commande;
    }

    public function setBonCommande(string $Bon_commande): static
    {
        $this->Bon_commande = $Bon_commande;

        return $this;
    }

    public function getDateFacturation(): ?\DateTimeInterface
    {
        return $this->Date_facturation;
    }

    public function setDateFacturation(\DateTimeInterface $Date_facturation): static
    {
        $this->Date_facturation = $Date_facturation;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * @return Collection<int, Livraison>
     */
    public function getLivraisons(): Collection
    {
        return $this->livraisons;
    }

    public function addLivraison(Livraison $livraison): static
    {
        if (!$this->livraisons->contains($livraison)) {
            $this->livraisons->add($livraison);
            $livraison->setCommande($this);
        }

        return $this;
    }

    public function removeLivraison(Livraison $livraison): static
    {
        if ($this->livraisons->removeElement($livraison)) {
            // set the owning side to null (unless already changed)
            if ($livraison->getCommande() === $this) {
                $livraison->setCommande(null);
            }
        }

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
            $concerne->setCommande($this);
        }

        return $this;
    }

    public function removeConcerne(Concerne $concerne): static
    {
        if ($this->concernes->removeElement($concerne)) {
            // set the owning side to null (unless already changed)
            if ($concerne->getCommande() === $this) {
                $concerne->setCommande(null);
            }
        }

        return $this;
    }
}
