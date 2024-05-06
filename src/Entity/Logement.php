<?php

namespace App\Entity;

use App\Repository\LogementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LogementRepository::class)]
class Logement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nbPlace = null;

    #[ORM\Column(length: 255)]
    private ?string $emplacement = null;

    #[ORM\ManyToOne(inversedBy: 'logements')]
    private ?Cathegorie $category = null;

    /**
     * @var Collection<int, Cathegorie>
     */
    #[ORM\OneToMany(targetEntity: Cathegorie::class, mappedBy: 'logement')]
    private Collection $appartient;

    public function __construct()
    {
        $this->appartient = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbPlace(): ?int
    {
        return $this->nbPlace;
    }

    public function setNbPlace(int $nbPlace): static
    {
        $this->nbPlace = $nbPlace;

        return $this;
    }

    public function getEmplacement(): ?string
    {
        return $this->emplacement;
    }

    public function setEmplacement(string $emplacement): static
    {
        $this->emplacement = $emplacement;

        return $this;
    }

    public function getCategory(): ?Cathegorie
    {
        return $this->category;
    }

    public function setCategory(?Cathegorie $category): static
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, Cathegorie>
     */
    public function getAppartient(): Collection
    {
        return $this->appartient;
    }

    public function addAppartient(Cathegorie $appartient): static
    {
        if (!$this->appartient->contains($appartient)) {
            $this->appartient->add($appartient);
            $appartient->setLogement($this);
        }

        return $this;
    }

    public function removeAppartient(Cathegorie $appartient): static
    {
        if ($this->appartient->removeElement($appartient)) {
            // set the owning side to null (unless already changed)
            if ($appartient->getLogement() === $this) {
                $appartient->setLogement(null);
            }
        }

        return $this;
    }
}
