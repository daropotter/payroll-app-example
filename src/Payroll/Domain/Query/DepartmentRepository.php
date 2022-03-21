<?php

declare(strict_types=1);

namespace App\Payroll\Domain\Query;

use App\Common\Domain\Identifier\ID;

interface DepartmentRepository
{
    public function getByID(ID $id): Department;
}
