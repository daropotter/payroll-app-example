<?php

declare(strict_types=1);

namespace App\Payroll\Domain\Salary\Policy;

class SalaryPolicyCreationException extends \Exception
{
    public function __construct()
    {
        parent::__construct("Creation of the salary policy failed.");
    }
}
