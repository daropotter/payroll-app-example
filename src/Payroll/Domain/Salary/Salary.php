<?php

declare(strict_types=1);

namespace App\Payroll\Domain\Salary;

use App\Common\Domain\Date;
use App\Payroll\Domain\Query\Employee;

/** @psalm-immutable */
class Salary
{
    private MoneyAmount $amount;

    public function __construct(
        private Employee $employee,
        Date $when,
        LengthOfServiceCalculator $calculator,
    ) {
        $this->amount = $employee->getSalaryForDay($when, $calculator);
    }

    public function getEmployee(): Employee
    {
        return $this->employee;
    }

    public function getAmount(): MoneyAmount
    {
        return $this->amount;
    }
}
