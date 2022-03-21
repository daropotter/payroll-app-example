<?php

declare(strict_types=1);

namespace App\Payroll\Application;

use App\Payroll\Domain\Query\ReportFiltering;
use App\Payroll\Domain\Query\ReportSorting;

/** @psalm-immutable */
class GetPayrollReportQuery
{
    public function __construct(
        public ReportSorting $sorting,
        public ReportFiltering $filtering,
    ) {
    }
}
