<?php

namespace App\Entity;

use App\Repository\AssignmentSubmissionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AssignmentSubmissionRepository::class)]
class AssignmentSubmission
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'assignmentSubmission')]
    private ?Student $student = null;

    #[ORM\ManyToOne(inversedBy: 'assignmentSubmission')]
    private ?Assignment $assignment = null;

    #[ORM\Column]
    private ?\DateTime $submissionDate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $filePath = null;

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

    public function getAssignment(): ?Assignment
    {
        return $this->assignment;
    }

    public function setAssignment(?Assignment $assignment): static
    {
        $this->assignment = $assignment;

        return $this;
    }

    public function getSubmissionDate(): ?\DateTime
    {
        return $this->submissionDate;
    }

    public function setSubmissionDate(\DateTime $submissionDate): static
    {
        $this->submissionDate = $submissionDate;

        return $this;
    }

    public function getFilePath(): ?string
    {
        return $this->filePath;
    }

    public function setFilePath(?string $filePath): static
    {
        $this->filePath = $filePath;

        return $this;
    }
}
