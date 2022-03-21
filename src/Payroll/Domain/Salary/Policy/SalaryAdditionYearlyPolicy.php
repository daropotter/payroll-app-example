<?php

declare(strict_types=1);

namespace App\Payroll\Domain\Salary\Policy;

use App\Payroll\Domain\Salary\LengthOfServiceInYears;
use App\Payroll\Domain\Salary\MoneyAmount;
use Webmozart\Assert\Assert;

/** @psalm-immutable */
class SalaryAdditionYearlyPolicy implements SalaryPolicy
{
    private const MAX_NUMBER_OF_YEARS = 10;

    public function __construct(private MoneyAmount $yearlyAddition)
    {
        Assert::greaterThanEq($this->yearlyAddition->getAsBCString(), 0);
    }

    public function getPolicyName(): string
    {
        return 'Yearly addition';
    }

    public function calculateSalary(MoneyAmount $baseSalary, LengthOfServiceInYears $lengthOfService): MoneyAmount
    {
        $years = min($lengthOfService->getValue(), self::MAX_NUMBER_OF_YEARS);
        $additionalSalary = $this->yearlyAddition->multiply((string)$years);
        return $baseSalary->add($additionalSalary);
    }
}
