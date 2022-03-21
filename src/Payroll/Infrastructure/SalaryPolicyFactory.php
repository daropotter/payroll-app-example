<?php

declare(strict_types=1);

namespace App\Payroll\Infrastructure;

use App\Payroll\Domain\Salary\MoneyAmount;
use App\Payroll\Domain\Salary\Policy\SalaryAdditionYearlyPolicy;
use App\Payroll\Domain\Salary\Policy\SalaryPercentageBonusPolicy;
use App\Payroll\Domain\Salary\Policy\SalaryPolicy;
use App\Payroll\Domain\Salary\Policy\SalaryPolicyCreationException;
use App\Payroll\Domain\Salary\Policy\SalaryPolicyFactory as SalaryPolicyFactoryInterface;
use Webmozart\Assert\Assert;

class SalaryPolicyFactory implements SalaryPolicyFactoryInterface
{
    public function getPolicy(array $options): SalaryPolicy
    {
        Assert::keyExists($options, 'name');
        switch ($options['name']) {
            case 'percentage_bonus':
                Assert::keyExists($options, 'percentage');
                Assert::numeric($options['percentage']);
                return new SalaryPercentageBonusPolicy(floatval($options['percentage']));
            case 'yearly_additional':
                Assert::keyExists($options, 'addition');
                Assert::numeric($options['addition']);
                Assert::string($options['addition']);
                return new SalaryAdditionYearlyPolicy(new MoneyAmount($options['addition']));
            default:
                throw new SalaryPolicyCreationException();
        }
    }
}
