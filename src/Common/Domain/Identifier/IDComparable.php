<?php

declare(strict_types=1);

namespace App\Common\Domain\Identifier;

interface IDComparable
{
    public function compareTo(Identifiable $otherObject): int;
}
