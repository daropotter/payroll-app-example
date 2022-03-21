<?php

declare(strict_types=1);

namespace App\Payroll\Presentation\Request;

use App\Common\Presentation\Sorting\Sorting;
use DigitalRevolution\SymfonyRequestValidation\AbstractValidatedRequest;
use DigitalRevolution\SymfonyRequestValidation\ValidationRules;

/** @psalm-immutable */
class ReportRequest extends AbstractValidatedRequest
{
    protected function getValidationRules(): ValidationRules
    {
        return new ValidationRules([
            'query' => [
                'sort' => 'string',
                'department' => 'string',
                'first_name' => 'string',
                'last_name' => 'string',
            ]
        ]);
    }

    /**
     * @return string[]
     */
    protected function getAllowedSortingFields(): array
    {
        return [
            'first_name',
            'last_name',
            'department',
            'base_salary',
            'additional_salary',
            'addition_type',
            'salary'
        ];
    }

    public function getSorting(): Sorting
    {
        /** @psalm-suppress ImpureMethodCall */
        $sorting = $this->request->query->get('sort') ?? 'last_name';
        return Sorting::fromString((string)$sorting, $this->getAllowedSortingFields());
    }

    public function getFilters(): ReportRequestFilter
    {
        /** @psalm-suppress ImpureMethodCall */
        return new ReportRequestFilter(
            (string)$this->request->query->get('department'),
            (string)$this->request->query->get('first_name'),
            (string)$this->request->query->get('last_name'),
        );
    }
}
