<?php

declare(strict_types=1);

namespace App\Payroll\Presentation\Controller;

use App\Common\Presentation\Sorting\SortOrder;
use App\Payroll\Application\GetPayrollReportQuery;
use App\Payroll\Application\GetPayrollReportQueryResult;
use App\Payroll\Application\Salary;
use App\Payroll\Domain\Query\ReportFiltering;
use App\Payroll\Domain\Query\ReportSorting;
use App\Payroll\Domain\Query\ReportSortingField;
use App\Payroll\Domain\Query\ReportSortingOrder;
use App\Payroll\Presentation\Request\ReportRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Annotation\Route;

/** @psalm-immutable */
class ReportController extends AbstractController
{
    #[Route('/report', name: 'app_payroll_report')]
    public function index(ReportRequest $request, MessageBusInterface $messageBus): Response
    {
        $sortBy = match ($request->getSorting()->getSortBy()) {
            'first_name' => ReportSortingField::FIRST_NAME(),
            'last_name' => ReportSortingField::LAST_NAME(),
            'department' => ReportSortingField::DEPARTMENT(),
            'base_salary' => ReportSortingField::BASE_SALARY(),
            'additional_salary' => ReportSortingField::ADDITIONAL_SALARY(),
            'addition_type' => ReportSortingField::ADDITION_TYPE(),
            'salary' => ReportSortingField::SALARY(),
            default => throw new \Exception('Unexpected sorting field value.')
        };

        $sortOrder = match ($request->getSorting()->getOrder()->getValue()) {
            SortOrder::ASCENDING => ReportSortingOrder::ASCENDING(),
            SortOrder::DESCENDING => ReportSortingOrder::DESCENDING(),
            default => throw new \Exception('Unexpected sorting order value.')
        };

        $query = new GetPayrollReportQuery(
            new ReportSorting(
                sortingField: new ReportSortingField($sortBy),
                sortingOrder: new ReportSortingOrder($sortOrder)
            ),
            new ReportFiltering(
                department: $request->getFilters()->getDepartment(),
                firstName: $request->getFilters()->getFirstName(),
                lastName: $request->getFilters()->getLastName()
            )
        );

        /** @psalm-suppress ImpureMethodCall */
        $envelope = $messageBus->dispatch($query);
        /** @var GetPayrollReportQueryResult $result */
        /** @psalm-suppress ImpureMethodCall */
        $result = $envelope->last(HandledStamp::class)->getResult();
        /** @psalm-suppress ImpureMethodCall */
        return $this->json(array_map(fn(Salary $salary)=> [
            'first_name' => $salary->firstName,
            'last_name' => $salary->lastName,
            'department' => $salary->department,
            'base_salary' => $salary->baseSalary,
            'additional_salary' => $salary->additionalSalary,
            'addition_type' => $salary->additionType,
            'salary' => $salary->salary,
        ], $result->getResult()));
    }
}
