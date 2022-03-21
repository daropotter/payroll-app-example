<?php

declare(strict_types=1);

namespace App\Payroll\Presentation\Request;

/** @psalm-immutable */
class ReportRequestFilter
{
    public function __construct(
        private string $department,
        private string $firstName,
        private string $lastName,
    ) {
    }

    public function getDepartment(): string
    {
        return $this->department;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }
}
