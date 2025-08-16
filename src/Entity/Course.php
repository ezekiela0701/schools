<?php

namespace App\Entity;

use App\Repository\CourseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CourseRepository::class)]
class Course
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'course')]
    private ?Classroom $classroom = null;

    #[ORM\ManyToOne(inversedBy: 'course')]
    private ?Subject $subject = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    /**
     * @var Collection<int, CourseFile>
     */
    #[ORM\OneToMany(targetEntity: CourseFile::class, mappedBy: 'course')]
    private Collection $courseFile;

    /**
     * @var Collection<int, Assignment>
     */
    #[ORM\OneToMany(targetEntity: Assignment::class, mappedBy: 'course')]
    private Collection $assignment;

    /**
     * @var Collection<int, Exam>
     */
    #[ORM\OneToMany(targetEntity: Exam::class, mappedBy: 'course')]
    private Collection $exam;

    public function __construct()
    {
        $this->courseFile = new ArrayCollection();
        $this->assignment = new ArrayCollection();
        $this->exam = new ArrayCollection();
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

    public function getSubject(): ?Subject
    {
        return $this->subject;
    }

    public function setSubject(?Subject $subject): static
    {
        $this->subject = $subject;

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

    /**
     * @return Collection<int, CourseFile>
     */
    public function getCourseFile(): Collection
    {
        return $this->courseFile;
    }

    public function addCourseFile(CourseFile $courseFile): static
    {
        if (!$this->courseFile->contains($courseFile)) {
            $this->courseFile->add($courseFile);
            $courseFile->setCourse($this);
        }

        return $this;
    }

    public function removeCourseFile(CourseFile $courseFile): static
    {
        if ($this->courseFile->removeElement($courseFile)) {
            // set the owning side to null (unless already changed)
            if ($courseFile->getCourse() === $this) {
                $courseFile->setCourse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Assignment>
     */
    public function getAssignment(): Collection
    {
        return $this->assignment;
    }

    public function addAssignment(Assignment $assignment): static
    {
        if (!$this->assignment->contains($assignment)) {
            $this->assignment->add($assignment);
            $assignment->setCourse($this);
        }

        return $this;
    }

    public function removeAssignment(Assignment $assignment): static
    {
        if ($this->assignment->removeElement($assignment)) {
            // set the owning side to null (unless already changed)
            if ($assignment->getCourse() === $this) {
                $assignment->setCourse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Exam>
     */
    public function getExam(): Collection
    {
        return $this->exam;
    }

    public function addExam(Exam $exam): static
    {
        if (!$this->exam->contains($exam)) {
            $this->exam->add($exam);
            $exam->setCourse($this);
        }

        return $this;
    }

    public function removeExam(Exam $exam): static
    {
        if ($this->exam->removeElement($exam)) {
            // set the owning side to null (unless already changed)
            if ($exam->getCourse() === $this) {
                $exam->setCourse(null);
            }
        }

        return $this;
    }
}
