<?php

declare(strict_types=1);

namespace App\Payroll\Domain\Salary\Policy;

interface SalaryPolicyFactory
{
    public function getPolicy(array $options): SalaryPolicy;
}
