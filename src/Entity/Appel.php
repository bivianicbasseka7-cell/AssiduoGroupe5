<?php

namespace App\Entity;

use App\Repository\AppelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AppelRepository::class)]
class Appel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $date_appel = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $horodatage_validation = null;

    #[ORM\Column]
    private ?bool $verrouille = null;

    #[ORM\ManyToOne(inversedBy: 'appels')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Creneau $creneau = null;

    /**
     * @var Collection<int, Presence>
     */
    #[ORM\OneToMany(targetEntity: Presence::class, mappedBy: 'appel')]
    private Collection $presences;

    public function __construct()
    {
        $this->presences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateAppel(): ?\DateTimeImmutable
    {
        return $this->date_appel;
    }

    public function setDateAppel(\DateTimeImmutable $date_appel): static
    {
        $this->date_appel = $date_appel;

        return $this;
    }

    public function getHorodatageValidation(): ?\DateTimeImmutable
    {
        return $this->horodatage_validation;
    }

    public function setHorodatageValidation(?\DateTimeImmutable $horodatage_validation): static
    {
        $this->horodatage_validation = $horodatage_validation;

        return $this;
    }

    public function isVerrouille(): ?bool
    {
        return $this->verrouille;
    }

    public function setVerrouille(bool $verrouille): static
    {
        $this->verrouille = $verrouille;

        return $this;
    }

    public function getCreneau(): ?Creneau
    {
        return $this->creneau;
    }

    public function setCreneau(?Creneau $creneau): static
    {
        $this->creneau = $creneau;

        return $this;
    }

    /**
     * @return Collection<int, Presence>
     */
    public function getPresences(): Collection
    {
        return $this->presences;
    }

    public function addPresence(Presence $presence): static
    {
        if (!$this->presences->contains($presence)) {
            $this->presences->add($presence);
            $presence->setAppel($this);
        }

        return $this;
    }

    public function removePresence(Presence $presence): static
    {
        if ($this->presences->removeElement($presence)) {
            // set the owning side to null (unless already changed)
            if ($presence->getAppel() === $this) {
                $presence->setAppel(null);
            }
        }

        return $this;
    }
}
