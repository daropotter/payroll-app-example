<?php

declare(strict_types=1);

namespace App\Common\Presentation\Sorting;

use DigitalRevolution\SymfonyRequestValidation\InvalidRequestException;

/** @psalm-immutable */
class Sorting
{
    public function __construct(
        private string $sortBy,
        private SortOrder $order
    ) {
    }

    /**
     * @param string[] $allowedSortingFields
     * @psalm-pure
     */
    public static function fromString(string $orderString, array $allowedSortingFields): self
    {
        [$orderBy, $direction] = self::extractSortingComponents($orderString);
        self::checkIfFieldIsAllowed($orderBy, $allowedSortingFields);
        self::checkOrderDirection($direction);

        return new self((string)$orderBy, new SortOrder((int)$direction));
    }

    private static function checkIfFieldIsAllowed(string $orderBy, array $allowedSortingFields): void
    {
        in_array($orderBy, $allowedSortingFields, true)
        || throw new InvalidRequestException('Not allowed sorting field.');
    }

    private static function checkOrderDirection(mixed $direction): void
    {
        in_array($direction, [-1, 1], true)
        || throw new InvalidRequestException('Invalid sorting order.');
    }

    /** @psalm-pure */
    private static function extractSortingComponents(string $orderString): array
    {
        $parts = explode(':', $orderString);
        count($parts) < 2 && $parts[1] = 1;
        is_numeric($parts[1]) && $parts[1] = (int)$parts[1];
        return $parts;
    }

    /**
     * @return string
     */
    public function getSortBy(): string
    {
        return $this->sortBy;
    }

    /**
     * @return SortOrder
     */
    public function getOrder(): SortOrder
    {
        return $this->order;
    }
}
