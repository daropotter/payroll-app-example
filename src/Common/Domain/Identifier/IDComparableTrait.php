<?php

declare(strict_types=1);

namespace App\Common\Domain\Identifier;

trait IDComparableTrait
{
    /** @psalm-pure */
    public function compareTo(Identifiable $otherObject): int
    {
        !is_a($this, get_class($otherObject))
        && !is_a($otherObject, get_class($this))
        && throw new IncomparableTypesException(get_class($this), get_class($otherObject));

        return $this->getID()->getId() <=> $otherObject->getID()->getId();
    }
}
