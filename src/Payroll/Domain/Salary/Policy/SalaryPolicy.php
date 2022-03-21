<?php

declare(strict_types=1);

namespace App\Payroll\Domain\Salary\Policy;

use App\Payroll\Domain\Salary\LengthOfServiceInYears;
use App\Payroll\Domain\Salary\MoneyAmount;

/** @psalm-immutable */
interface SalaryPolicy
{
    public function getPolicyName(): string;

    public function calculateSalary(MoneyAmount $baseSalary, LengthOfServiceInYears $lengthOfService): MoneyAmount;
}
