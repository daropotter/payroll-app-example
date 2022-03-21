<?php

declare(strict_types=1);

namespace App\Payroll\Domain\Query;

class ReportSorting
{
    public function __construct(
        private ReportSortingField $sortingField,
        private ReportSortingOrder $sortingOrder,
    ) {
    }

    public function getSortingField(): ReportSortingField
    {
        return $this->sortingField;
    }

    public function getSortingOrder(): ReportSortingOrder
    {
        return $this->sortingOrder;
    }
}
