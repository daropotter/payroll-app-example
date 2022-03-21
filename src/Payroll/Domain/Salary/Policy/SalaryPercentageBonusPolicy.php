<?php

namespace App\Payroll\Domain\Salary\Policy;

use App\Payroll\Domain\Salary\LengthOfServiceInYears;
use App\Payroll\Domain\Salary\MoneyAmount;
use Webmozart\Assert\Assert;

/** @psalm-immutable */
class SalaryPercentageBonusPolicy implements SalaryPolicy
{
    public function __construct(private float $percentage)
    {
        Assert::greaterThanEq($percentage, 0);
    }

    public function getPolicyName(): string
    {
        return 'Percentage bonus';
    }

    public function calculateSalary(MoneyAmount $baseSalary, LengthOfServiceInYears $lengthOfService): MoneyAmount
    {
        /** @var numeric-string $factor */
        $factor = number_format(($this->percentage + 100) / 100, 2);
        return $baseSalary->multiply($factor);
    }
}
