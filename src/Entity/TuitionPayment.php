<?php

namespace App\Entity;

use App\Repository\TuitionPaymentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TuitionPaymentRepository::class)]
class TuitionPayment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'tuitionPayment')]
    private ?Student $student = null;

    #[ORM\ManyToOne(inversedBy: 'tuitionPayment')]
    private ?Tuition $tuition = null;

    #[ORM\Column]
    private ?float $amountPaid = null;

    #[ORM\Column]
    private ?\DateTime $paymentDate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(?Student $student): static
    {
        $this->student = $student;

        return $this;
    }

    public function getTuition(): ?Tuition
    {
        return $this->tuition;
    }

    public function setTuition(?Tuition $tuition): static
    {
        $this->tuition = $tuition;

        return $this;
    }

    public function getAmountPaid(): ?float
    {
        return $this->amountPaid;
    }

    public function setAmountPaid(float $amountPaid): static
    {
        $this->amountPaid = $amountPaid;

        return $this;
    }

    public function getPaymentDate(): ?\DateTime
    {
        return $this->paymentDate;
    }

    public function setPaymentDate(\DateTime $paymentDate): static
    {
        $this->paymentDate = $paymentDate;

        return $this;
    }
}
