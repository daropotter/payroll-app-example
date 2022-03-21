<?php

declare(strict_types=1);

namespace App\Common\Domain;

/** @psalm-immutable */
class Date
{
    public function __construct(private \DateTimeImmutable $dateTime)
    {
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDateTime(): \DateTimeImmutable
    {
        return $this->dateTime;
    }
}
