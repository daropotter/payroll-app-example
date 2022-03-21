<?php

namespace App\Payroll\Application;

use App\Payroll\Domain\Salary\Salary;
use App\Payroll\Application\Salary as SalaryDTO;

/** @psalm-immutable */
class GetPayrollReportQueryResult
{
    /** @var SalaryDTO[]  */
    private array $result;

    /**
     * @param Salary[] $result
     */
    public function __construct(array $result)
    {
        /** @psalm-suppress ImpureFunctionCall */
        $this->result = array_map(fn(Salary $salary) => $this->transformSalary($salary), $result);
    }

    private function transformSalary(Salary $salary): SalaryDTO
    {
        return new SalaryDTO(
            firstName: $salary->getEmployee()->getFirstName(),
            lastName: $salary->getEmployee()->getLastName(),
            department: $salary->getEmployee()->getDepartment()->getName(),
            baseSalary: $salary->getEmployee()->getBaseSalary()->getAsBCString(),
            additionalSalary: $salary->getAmount()->subtract($salary->getEmployee()->getBaseSalary())->getAsBCString(),
            additionType: $salary->getEmployee()->getDepartment()->getUsedPolicyName(),
            salary: $salary->getAmount()->getAsBCString(),
        );
    }

    /**
     * @return SalaryDTO[]
     */
    public function getResult(): array
    {
        return $this->result;
    }
}
