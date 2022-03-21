<?php

declare(strict_types=1);

namespace App\Payroll\Domain\Query;

interface EmployeeRepository
{
    /**
     * @return Employee[]
     */
    public function findAll(): array;
}
