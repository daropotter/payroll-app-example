<?php

declare(strict_types=1);

namespace App\Payroll\Infrastructure;

use App\Common\Domain\Date;
use App\Common\Domain\Identifier\ID;
use App\Payroll\Domain\Salary\MoneyAmount;
use App\Payroll\Infrastructure\Doctrine\Entity\Employee as EmployeeEntity;
use App\Payroll\Domain\Query\DepartmentRepository;
use App\Payroll\Domain\Query\Employee;
use App\Payroll\Domain\Query\EmployeeRepository as EmployeeRepositoryInterface;
use App\Payroll\Infrastructure\Doctrine\Repository\EmployeeRepository;

class DoctrineEmployeeRepository implements EmployeeRepositoryInterface
{
    public function __construct(
        private EmployeeRepository $ORMEmployeeRepository,
        private DepartmentRepository $departmentRepository,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function findAll(): array
    {
        return array_map(fn(EmployeeEntity $entity) => new Employee(
            id: new ID($entity->getId()),
            firstName: $entity->getFirstName(),
            lastName: $entity->getLastName(),
            startOfService: new Date($entity->getStartOfService()),
            department: $this->departmentRepository->getByID(new ID($entity->getDepartment()->getId())),
            baseSalary: new MoneyAmount($entity->getBaseSalary()),
        ), $this->ORMEmployeeRepository->findAll());
    }
}
