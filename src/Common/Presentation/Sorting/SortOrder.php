<?php

declare(strict_types=1);

namespace App\Common\Presentation\Sorting;

use MyCLabs\Enum\Enum;

/** @psalm-immutable */
final class SortOrder extends Enum
{
    public const ASCENDING = 1;
    public const DESCENDING = -1;
}
