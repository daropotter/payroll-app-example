<?php

namespace App\Payroll\Infrastructure\Doctrine\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
class Employee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $firstName;

    #[ORM\Column(type: 'string', length: 255)]
    private $lastName;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private $baseSalary;

    #[ORM\ManyToOne(targetEntity: Department::class, inversedBy: 'employees')]
    #[ORM\JoinColumn(nullable: false)]
    private $department;

    #[ORM\Column(type: 'date_immutable')]
    private $startOfService;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getBaseSalary(): ?string
    {
        return $this->baseSalary;
    }

    public function setBaseSalary(string $baseSalary): self
    {
        $this->baseSalary = $baseSalary;

        return $this;
    }

    public function getDepartment(): ?Department
    {
        return $this->department;
    }

    public function setDepartment(?Department $department): self
    {
        $this->department = $department;

        return $this;
    }

    public function getStartOfService(): ?\DateTimeImmutable
    {
        return $this->startOfService;
    }

    public function setStartOfService(\DateTimeImmutable $startOfService): self
    {
        $this->startOfService = $startOfService;

        return $this;
    }
}
