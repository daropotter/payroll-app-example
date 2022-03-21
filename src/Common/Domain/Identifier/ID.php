<?php

declare(strict_types=1);

namespace App\Common\Domain\Identifier;

class ID
{
    public function __construct(private string|int $id)
    {
    }

    public function getId(): string|int
    {
        return $this->id;
    }
}
