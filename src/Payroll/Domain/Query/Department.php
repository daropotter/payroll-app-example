<?php

declare(strict_types=1);

namespace App\Payroll\Domain\Query;

use App\Common\Domain\Date;
use App\Common\Domain\Identifier\ID;
use App\Common\Domain\Identifier\IDComparable;
use App\Common\Domain\Identifier\IDComparableTrait;
use App\Common\Domain\Identifier\Identifiable;
use App\Payroll\Domain\Salary\LengthOfServiceCalculator;
use App\Payroll\Domain\Salary\MoneyAmount;
use App\Payroll\Domain\Salary\Policy\SalaryPolicy;
use Webmozart\Assert\Assert;

/** @psalm-immutable */
class Department implements IDComparable, Identifiable
{
    use IDComparableTrait;

    public function __construct(
        private ID $id,
        private string $name,
        private SalaryPolicy $salaryPolicy,
    ) {
    }

    public function getUsedPolicyName(): string
    {
        return $this->salaryPolicy->getPolicyName();
    }

    public function getEmployeeSalaryForDay(
        Employee $employee,
        Date $date,
        LengthOfServiceCalculator $calculator
    ): MoneyAmount {
        Assert::eq(
            $this->compareTo($employee->getDepartment()),
            0,
            "Tried to get salary of an employee from outside the department."
        );

        $lengthOfService = $calculator->getLengthOfService($employee, $date);
        $baseSalary = $employee->getBaseSalary();

        return $this->salaryPolicy->calculateSalary($baseSalary, $lengthOfService);
    }

    public function getID(): ID
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
