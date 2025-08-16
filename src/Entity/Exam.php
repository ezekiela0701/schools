<?php

namespace App\Entity;

use App\Repository\ExamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExamRepository::class)]
class Exam
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'exam')]
    private ?Course $course = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTime $examDate = null;

    /**
     * @var Collection<int, ExamResult>
     */
    #[ORM\OneToMany(targetEntity: ExamResult::class, mappedBy: 'exam')]
    private Collection $examResult;

    public function __construct()
    {
        $this->examResult = new ArrayCollection();
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

    public function getExamDate(): ?\DateTime
    {
        return $this->examDate;
    }

    public function setExamDate(\DateTime $examDate): static
    {
        $this->examDate = $examDate;

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
            $examResult->setExam($this);
        }

        return $this;
    }

    public function removeExamResult(ExamResult $examResult): static
    {
        if ($this->examResult->removeElement($examResult)) {
            // set the owning side to null (unless already changed)
            if ($examResult->getExam() === $this) {
                $examResult->setExam(null);
            }
        }

        return $this;
    }
}
