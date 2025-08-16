<?php

namespace App\Entity;

use App\Repository\TuitionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TuitionRepository::class)]
class Tuition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $amount = null;

    /**
     * @var Collection<int, TuitionPayment>
     */
    #[ORM\OneToMany(targetEntity: TuitionPayment::class, mappedBy: 'tuition')]
    private Collection $tuitionPayment;

    public function __construct()
    {
        $this->tuitionPayment = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return Collection<int, TuitionPayment>
     */
    public function getTuitionPayment(): Collection
    {
        return $this->tuitionPayment;
    }

    public function addTuitionPayment(TuitionPayment $tuitionPayment): static
    {
        if (!$this->tuitionPayment->contains($tuitionPayment)) {
            $this->tuitionPayment->add($tuitionPayment);
            $tuitionPayment->setTuition($this);
        }

        return $this;
    }

    public function removeTuitionPayment(TuitionPayment $tuitionPayment): static
    {
        if ($this->tuitionPayment->removeElement($tuitionPayment)) {
            // set the owning side to null (unless already changed)
            if ($tuitionPayment->getTuition() === $this) {
                $tuitionPayment->setTuition(null);
            }
        }

        return $this;
    }
}
