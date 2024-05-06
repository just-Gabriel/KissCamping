<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column]
    private ?int $nbPersonne = null;

    #[ORM\Column]
    private ?int $nbJourSurSite = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $avis = null;

    /**
     * @var Collection<int, Reservation>
     */
    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'client')]
    private Collection $reservations;

    /**
     * @var Collection<int, Reservation>
     */
    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'clients')]
    private Collection $client;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->client = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
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

    public function getNbPersonne(): ?int
    {
        return $this->nbPersonne;
    }

    public function setNbPersonne(int $nbPersonne): static
    {
        $this->nbPersonne = $nbPersonne;

        return $this;
    }

    public function getNbJourSurSite(): ?int
    {
        return $this->nbJourSurSite;
    }

    public function setNbJourSurSite(int $nbJourSurSite): static
    {
        $this->nbJourSurSite = $nbJourSurSite;

        return $this;
    }

    public function getAvis(): ?string
    {
        return $this->avis;
    }

    public function setAvis(?string $avis): static
    {
        $this->avis = $avis;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setClient($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getClient() === $this) {
                $reservation->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getClient(): Collection
    {
        return $this->client;
    }

    public function addClient(Reservation $client): static
    {
        if (!$this->client->contains($client)) {
            $this->client->add($client);
            $client->setClients($this);
        }

        return $this;
    }

    public function removeClient(Reservation $client): static
    {
        if ($this->client->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getClients() === $this) {
                $client->setClients(null);
            }
        }

        return $this;
    }
}
