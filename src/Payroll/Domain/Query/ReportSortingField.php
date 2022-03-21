<?php

declare(strict_types=1);

namespace App\Payroll\Domain\Query;

use MyCLabs\Enum\Enum;

/**
 * @method static FIRST_NAME(): self
 * @method static LAST_NAME(): self
 * @method static DEPARTMENT(): self
 * @method static BASE_SALARY(): self
 * @method static ADDITIONAL_SALARY(): self
 * @method static ADDITION_TYPE(): self
 * @method static SALARY(): self
 * @psalm-immutable
 */
final class ReportSortingField extends Enum
{
    public const FIRST_NAME = 1;
    public const LAST_NAME = 2;
    public const DEPARTMENT = 3;
    public const BASE_SALARY = 4;
    public const ADDITIONAL_SALARY = 5;
    public const ADDITION_TYPE = 6;
    public const SALARY = 7;
}
