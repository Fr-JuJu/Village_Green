<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 100)]
    private ?string $Nom_utilisateur = null;

    #[ORM\Column(length: 255)]
    private ?string $Type_utilisateur = null;

    #[ORM\Column(length: 255)]
    private ?string $Adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $Telephone = null;

    #[ORM\Column(length: 255)]
    private ?string $Adresse_facturation = null;

    #[ORM\Column(length: 255)]
    private ?string $Adresse_livraison = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Historique_connexion = null;

    #[ORM\Column(length: 9, nullable: true)]
    private ?string $Numero_siren = null;

    /**
     * @var Collection<int, Commande>
     */
    #[ORM\OneToMany(targetEntity: Commande::class, mappedBy: 'utilisateur')]
    private Collection $commandes;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNomUtilisateur(): ?string
    {
        return $this->Nom_utilisateur;
    }

    public function setNomUtilisateur(string $Nom_utilisateur): static
    {
        $this->Nom_utilisateur = $Nom_utilisateur;

        return $this;
    }

    public function getTypeUtilisateur(): ?string
    {
        return $this->Type_utilisateur;
    }

    public function setTypeUtilisateur(string $Type_utilisateur): static
    {
        $this->Type_utilisateur = $Type_utilisateur;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): static
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->Telephone;
    }

    public function setTelephone(string $Telephone): static
    {
        $this->Telephone = $Telephone;

        return $this;
    }

    public function getAdresseFacturation(): ?string
    {
        return $this->Adresse_facturation;
    }

    public function setAdresseFacturation(string $Adresse_facturation): static
    {
        $this->Adresse_facturation = $Adresse_facturation;

        return $this;
    }

    public function getAdresseLivraison(): ?string
    {
        return $this->Adresse_livraison;
    }

    public function setAdresseLivraison(string $Adresse_livraison): static
    {
        $this->Adresse_livraison = $Adresse_livraison;

        return $this;
    }

    public function getHistoriqueConnexion(): ?string
    {
        return $this->Historique_connexion;
    }

    public function setHistoriqueConnexion(?string $Historique_connexion): static
    {
        $this->Historique_connexion = $Historique_connexion;

        return $this;
    }

    public function getNumeroSiren(): ?string
    {
        return $this->Numero_siren;
    }

    public function setNumeroSiren(?string $Numero_siren): static
    {
        $this->Numero_siren = $Numero_siren;

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): static
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes->add($commande);
            $commande->setUtilisateur($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): static
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getUtilisateur() === $this) {
                $commande->setUtilisateur(null);
            }
        }

        return $this;
    }
}
