<?php

declare(strict_types=1);

namespace App\Common\Domain\Identifier;

class IncomparableTypesException extends \Exception
{
    public function __construct(string $type1, string $type2)
    {
        parent::__construct("Types {$type1} and {$type2} are not comparable with each other.");
    }
}
