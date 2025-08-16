<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'student')]
    private ?Classroom $classroom = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column]
    private ?\DateTime $dateOfBirth = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $phone = null;

    /**
     * @var Collection<int, TuitionPayment>
     */
    #[ORM\OneToMany(targetEntity: TuitionPayment::class, mappedBy: 'student')]
    private Collection $tuitionPayment;

    /**
     * @var Collection<int, AssignmentSubmission>
     */
    #[ORM\OneToMany(targetEntity: AssignmentSubmission::class, mappedBy: 'student')]
    private Collection $assignmentSubmission;

    /**
     * @var Collection<int, ExamResult>
     */
    #[ORM\OneToMany(targetEntity: ExamResult::class, mappedBy: 'student')]
    private Collection $examResult;

    public function __construct()
    {
        $this->tuitionPayment = new ArrayCollection();
        $this->assignmentSubmission = new ArrayCollection();
        $this->examResult = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClassroom(): ?Classroom
    {
        return $this->classroom;
    }

    public function setClassroom(?Classroom $classroom): static
    {
        $this->classroom = $classroom;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTime
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(\DateTime $dateOfBirth): static
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

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
            $tuitionPayment->setStudent($this);
        }

        return $this;
    }

    public function removeTuitionPayment(TuitionPayment $tuitionPayment): static
    {
        if ($this->tuitionPayment->removeElement($tuitionPayment)) {
            // set the owning side to null (unless already changed)
            if ($tuitionPayment->getStudent() === $this) {
                $tuitionPayment->setStudent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AssignmentSubmission>
     */
    public function getAssignmentSubmission(): Collection
    {
        return $this->assignmentSubmission;
    }

    public function addAssignmentSubmission(AssignmentSubmission $assignmentSubmission): static
    {
        if (!$this->assignmentSubmission->contains($assignmentSubmission)) {
            $this->assignmentSubmission->add($assignmentSubmission);
            $assignmentSubmission->setStudent($this);
        }

        return $this;
    }

    public function removeAssignmentSubmission(AssignmentSubmission $assignmentSubmission): static
    {
        if ($this->assignmentSubmission->removeElement($assignmentSubmission)) {
            // set the owning side to null (unless already changed)
            if ($assignmentSubmission->getStudent() === $this) {
                $assignmentSubmission->setStudent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ExamResult>
     */
    public function getExamResult(): Collection
    {
        return $this->examResult;
    }

    public function addExamResult(ExamResult $examResult): static
    {
        if (!$this->examResult->contains($examResult)) {
            $this->examResult->add($examResult);
            $examResult->setStudent($this);
        }

        return $this;
    }

    public function removeExamResult(ExamResult $examResult): static
    {
        if ($this->examResult->removeElement($examResult)) {
            // set the owning side to null (unless already changed)
            if ($examResult->getStudent() === $this) {
                $examResult->setStudent(null);
            }
        }

        return $this;
    }
}
