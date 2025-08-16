<?php

namespace App\Entity;

use App\Repository\AssignmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AssignmentRepository::class)]
class Assignment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'assignment')]
    private ?Course $course = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTime $dueDate = null;

    /**
     * @var Collection<int, AssignmentSubmission>
     */
    #[ORM\OneToMany(targetEntity: AssignmentSubmission::class, mappedBy: 'assignment')]
    private Collection $assignmentSubmission;

    public function __construct()
    {
        $this->assignmentSubmission = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCourse(): ?Course
    {
        return $this->course;
    }

    public function setCourse(?Course $course): static
    {
        $this->course = $course;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDueDate(): ?\DateTime
    {
        return $this->dueDate;
    }

    public function setDueDate(\DateTime $dueDate): static
    {
        $this->dueDate = $dueDate;

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
            $assignmentSubmission->setAssignment($this);
        }

        return $this;
    }

    public function removeAssignmentSubmission(AssignmentSubmission $assignmentSubmission): static
    {
        if ($this->assignmentSubmission->removeElement($assignmentSubmission)) {
            // set the owning side to null (unless already changed)
            if ($assignmentSubmission->getAssignment() === $this) {
                $assignmentSubmission->setAssignment(null);
            }
        }

        return $this;
    }
}
