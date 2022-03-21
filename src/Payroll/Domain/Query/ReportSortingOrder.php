<?php

declare(strict_types=1);

namespace App\Payroll\Domain\Query;

use MyCLabs\Enum\Enum;

/**
 * @method static ASCENDING(): self
 * @method static DESCENDING(): self
 * @psalm-immutable
 */
final class ReportSortingOrder extends Enum
{
    public const ASCENDING = 1;
    public const DESCENDING = 2;
}
