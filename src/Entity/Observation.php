<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\ObservationRepository;
use App\Validator\IdentificationQualityConstraint;
use Doctrine\ORM\Mapping as ORM;
use App\Validator\SpeciesConstraint;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

#[ORM\Entity(repositoryClass: ObservationRepository::class)]
#[
    ApiResource,
    ApiFilter(
        SearchFilter::class,
        properties: [
            'species_observe' => SearchFilter::STRATEGY_EXACT
        ]
    )
]
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
    #[IdentificationQualityConstraint]
    private ?string $identification_quality = null;

    #[ORM\Column(nullable: true)]
    private ?float $individual_size = null;

    #[ORM\Column(nullable: true)]
    private ?float $observed_dive = null;

    #[ORM\Column(nullable: true)]
    private ?bool $school_of_fish = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\Column(length: 255)]
    private ?string $species_observe = null;

    #[ORM\Column(length: 255)]
    #[SpeciesConstraint]
    private ?string $species = null;

    #[ORM\Column(nullable: true)]
    private ?int $individuals_estimate = null;

    #[Assert\Callback]
    public function validate(ExecutionContextInterface $context, $payload): void
    {
        if ($this->species === 'fish' && empty($this->school_of_fish)) {
            $context->buildViolation('The school_of_fish field cannot be empty when species is "fish".')
                ->atPath('school_of_fish')
                ->addViolation();
        }
        if ($this->school_of_fish === true && empty($this->individuals_estimate)) {
            $context->buildViolation('The individuals_estimate field cannot be empty when species is "fish".')
                ->atPath('school_of_fish')
                ->addViolation();
        }
        if ($this->species === 'marine mammal' && empty($this->observed_dive)) {
            $context->buildViolation('The observed_dive field cannot be empty when species is "marine mammal".')
                ->atPath('observed_dive')
                ->addViolation();
        }
    }

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

    public function getSpeciesObserve(): ?string
    {
        return $this->species_observe;
    }

    public function setSpeciesObserve(string $species_observe): static
    {
        $this->species_observe = $species_observe;

        return $this;
    }

    public function getSpecies(): ?string
    {
        return $this->species;
    }

    public function setSpecies(string $species): static
    {
        $this->species = $species;

        return $this;
    }

    public function getIndividualsEstimate(): ?int
    {
        return $this->individuals_estimate;
    }

    public function setIndividualsEstimate(?int $individuals_estimate): static
    {
        $this->individuals_estimate = $individuals_estimate;

        return $this;
    }
}
