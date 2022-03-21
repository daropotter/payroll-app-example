<?php

declare(strict_types=1);

namespace App\Payroll\Domain\Salary;

/** @psalm-immutable */
class LengthOfServiceInYears
{
    public function __construct(private int $value)
    {
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
