<?php

declare(strict_types=1);

namespace App\Payroll\Application;

/** @psalm-immutable */
class Salary
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $department,
        public string $baseSalary,
        public string $additionalSalary,
        public string $additionType,
        public string $salary,
    ) {
    }
}
