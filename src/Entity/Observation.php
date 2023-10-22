<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ObservationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ObservationRepository::class)]
#[ApiResource]
class Observation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $island = null;

    #[ORM\Column]
    private ?float $distance = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $observation_at = null;

    #[ORM\Column(length: 255)]
    private ?string $identification_quality = null;

    #[ORM\Column(nullable: true)]
    private ?float $individual_size = null;

    #[ORM\Column(nullable: true)]
    private ?float $observed_dive = null;

    #[ORM\Column]
    private ?bool $school_of_fish = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsland(): ?string
    {
        return $this->island;
    }

    public function setIsland(string $island): static
    {
        $this->island = $island;

        return $this;
    }

    public function getDistance(): ?float
    {
        return $this->distance;
    }

    public function setDistance(float $distance): static
    {
        $this->distance = $distance;

        return $this;
    }

    public function getObservationAt(): ?\DateTimeImmutable
    {
        return $this->observation_at;
    }

    public function setObservationAt(\DateTimeImmutable $observation_at): static
    {
        $this->observation_at = $observation_at;

        return $this;
    }

    public function getIdentificationQuality(): ?string
    {
        return $this->identification_quality;
    }

    public function setIdentificationQuality(string $identification_quality): static
    {
        $this->identification_quality = $identification_quality;

        return $this;
    }

    public function getIndividualSize(): ?float
    {
        return $this->individual_size;
    }

    public function setIndividualSize(?float $individual_size): static
    {
        $this->individual_size = $individual_size;

        return $this;
    }

    public function getObservedDive(): ?float
    {
        return $this->observed_dive;
    }

    public function setObservedDive(?float $observed_dive): static
    {
        $this->observed_dive = $observed_dive;

        return $this;
    }

    public function isSchoolOfFish(): ?bool
    {
        return $this->school_of_fish;
    }

    public function setSchoolOfFish(bool $school_of_fish): static
    {
        $this->school_of_fish = $school_of_fish;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
