<?php

declare(strict_types=1);

namespace App\Common\Domain\Identifier;

interface Identifiable
{
    public function getID(): ID;
}
