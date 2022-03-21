<?php

declare(strict_types=1);

namespace App\Payroll\Domain\Query;

use App\Common\Domain\Date;
use App\Common\Domain\Identifier\ID;
use App\Common\Domain\Identifier\Identifiable;
use App\Payroll\Domain\Salary\LengthOfServiceCalculator;
use App\Payroll\Domain\Salary\MoneyAmount;

/** @psalm-immutable */
class Employee implements Identifiable
{
    public function __construct(
        private ID $id,
        private string $firstName,
        private string $lastName,
        private Date $startOfService,
        private Department $department,
        private MoneyAmount $baseSalary,
    ) {
    }

    public function getSalaryForDay(Date $when, LengthOfServiceCalculator $calculator): MoneyAmount
    {
        return $this->department->getEmployeeSalaryForDay($this, $when, $calculator);
    }

    public function getID(): ID
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getStartOfService(): Date
    {
        return $this->startOfService;
    }

    public function getDepartment(): Department
    {
        return $this->department;
    }

    public function getBaseSalary(): MoneyAmount
    {
        return $this->baseSalary;
    }
}
