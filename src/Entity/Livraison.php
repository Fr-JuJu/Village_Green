<?php

namespace App\Entity;

use App\Repository\LivraisonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LivraisonRepository::class)]
class Livraison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Date_livraison = null;

    #[ORM\Column(length: 50)]
    private ?string $Delais_livraison = null;

    #[ORM\Column(length: 50)]
    private ?string $Statut_livraison = null;

    #[ORM\ManyToOne(inversedBy: 'livraisons')]
    private ?Commande $commande = null;

    /**
     * @var Collection<int, Contient>
     */
    #[ORM\OneToMany(targetEntity: Contient::class, mappedBy: 'livraison')]
    private Collection $contients;

    public function __construct()
    {
        $this->contients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateLivraison(): ?\DateTimeInterface
    {
        return $this->Date_livraison;
    }

    public function setDateLivraison(\DateTimeInterface $Date_livraison): static
    {
        $this->Date_livraison = $Date_livraison;

        return $this;
    }

    public function getDelaisLivraison(): ?string
    {
        return $this->Delais_livraison;
    }

    public function setDelaisLivraison(string $Delais_livraison): static
    {
        $this->Delais_livraison = $Delais_livraison;

        return $this;
    }

    public function getStatutLivraison(): ?string
    {
        return $this->Statut_livraison;
    }

    public function setStatutLivraison(string $Statut_livraison): static
    {
        $this->Statut_livraison = $Statut_livraison;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): static
    {
        $this->commande = $commande;

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
            $contient->setLivraison($this);
        }

        return $this;
    }

    public function removeContient(Contient $contient): static
    {
        if ($this->contients->removeElement($contient)) {
            // set the owning side to null (unless already changed)
            if ($contient->getLivraison() === $this) {
                $contient->setLivraison(null);
            }
        }

        return $this;
    }
}
