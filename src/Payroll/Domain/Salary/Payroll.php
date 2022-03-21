<?php

declare(strict_types=1);

namespace App\Payroll\Domain\Salary;

use App\Common\Domain\Date;
use App\Payroll\Domain\Query\Employee;

/** @psalm-immutable */
class Payroll
{
    /**
     * @param Employee[] $employees
     */
    public function __construct(
        private array $employees,
        private Date $date,
        private LengthOfServiceCalculator $lengthOfServiceCalculator,
    ) {
    }

    /** @return Salary[] */
    public function getSalaries(): array
    {
        /** @psalm-suppress ImpureFunctionCall */
        return array_map(
            fn(Employee $employee) => new Salary($employee, $this->date, $this->lengthOfServiceCalculator),
            $this->employees
        );
    }
}
