<?php

declare(strict_types=1);

namespace App\Payroll\Infrastructure;

use App\Common\Domain\Identifier\ID;
use App\Payroll\Domain\Query\Department;
use App\Payroll\Domain\Query\DepartmentRepository as DepartmentRepositoryInterface;
use App\Payroll\Domain\Salary\Policy\SalaryPolicyFactory as SalaryPolicyFactoryInterface;
use App\Payroll\Infrastructure\Doctrine\Repository\DepartmentRepository;

class DoctrineDepartmentRepository implements DepartmentRepositoryInterface
{
    public function __construct(
        private DepartmentRepository $ORMDepartmentRepository,
        private SalaryPolicyFactoryInterface $salaryPolicyFactory,
    ) {
    }
    public function getByID(ID $id): Department
    {
        $entity = $this->ORMDepartmentRepository->find($id->getId());
        return new Department(
            id: new ID($entity->getId()),
            name: $entity->getName(),
            salaryPolicy: $this->salaryPolicyFactory->getPolicy([
                'name' => $entity->getSalaryPolicy()->getName(),
                'addition' => $entity->getSalaryPolicy()->getAddition(),
                'percentage' => $entity->getSalaryPolicy()->getPercentage()
            ])
        );
    }
}
