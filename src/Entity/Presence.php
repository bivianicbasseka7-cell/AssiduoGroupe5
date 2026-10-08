<?php

namespace App\Entity;

use App\Repository\PresenceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PresenceRepository::class)]
class Presence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $statut = null;

    #[ORM\Column(nullable: true)]
    private ?int $duree_retard_min = null;

    #[ORM\ManyToOne(inversedBy: 'presences')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Appel $appel = null;

    #[ORM\ManyToOne(inversedBy: 'presences')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Eleve $eleve = null;

    #[ORM\OneToOne(mappedBy: 'presence', cascade: ['persist', 'remove'])]
    private ?Justificatif $justificatif = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getDureeRetardMin(): ?int
    {
        return $this->duree_retard_min;
    }

    public function setDureeRetardMin(?int $duree_retard_min): static
    {
        $this->duree_retard_min = $duree_retard_min;

        return $this;
    }

    public function getAppel(): ?Appel
    {
        return $this->appel;
    }

    public function setAppel(?Appel $appel): static
    {
        $this->appel = $appel;

        return $this;
    }

    public function getEleve(): ?Eleve
    {
        return $this->eleve;
    }

        public function getJustificatif(): ?Justificatif
    {
        return $this->justificatif;
    }

    public function setJustificatif(?Justificatif $justificatif): static
    {
        $this->justificatif = $justificatif;

        return $this;
    }
    
    public function setEleve(?Eleve $eleve): static
    {
        $this->eleve = $eleve;

        return $this;
    }
}