<?php

declare(strict_types=1);

namespace App\Payroll\Domain\Salary;

use App\Common\Domain\Date;
use App\Payroll\Domain\Query\Employee;

/** @psalm-immutable */
class LengthOfServiceCalculator
{
    public function getLengthOfService(Employee $employee, Date $date): LengthOfServiceInYears
    {
        return $this->calculate($employee->getStartOfService(), $date);
    }

    private function calculate(Date $from, Date $to): LengthOfServiceInYears
    {
        $diff = $to->getDateTime()->diff($from->getDateTime());
        return new LengthOfServiceInYears($diff->y);
    }
}
