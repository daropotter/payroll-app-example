<?php

declare(strict_types=1);

namespace App\Payroll\Domain;

use App\Common\Domain\Date;
use App\Payroll\Domain\Query\EmployeeRepository;
use App\Payroll\Domain\Salary\LengthOfServiceCalculator;
use App\Payroll\Domain\Salary\Payroll;

/** @psalm-immutable */
class PayrollFacade
{
    public function __construct(
        private EmployeeRepository $employeeRepository,
        private Date $currentDate,
        private LengthOfServiceCalculator $lengthOfServiceCalculator,
    ) {
    }

    public function getCurrentPayroll(): Payroll
    {
        return new Payroll(
            $this->employeeRepository->findAll(),
            $this->currentDate,
            $this->lengthOfServiceCalculator,
        );
    }
}
