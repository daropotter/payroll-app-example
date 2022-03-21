<?php

declare(strict_types=1);

namespace App\Payroll\Domain\Salary;

use Webmozart\Assert\Assert;

/** @psalm-immutable */
class MoneyAmount
{
    /** @var numeric-string */
    private string $amount;

    public function __construct(string $bcString, private int $precision = 2)
    {
        Assert::numeric($bcString);
        Assert::greaterThanEq($bcString, 0);
        Assert::greaterThanEq($precision, 0);
        $this->amount = $bcString;
    }

    public function getAsBCString(): string
    {
        return $this->amount;
    }

    public function add(MoneyAmount $amount): self
    {
        return new self(bcadd($this->amount, $amount->amount, $this->precision));
    }

    public function subtract(MoneyAmount $amount): self
    {
        return new self(bcsub($this->amount, $amount->amount, $this->precision));
    }

    /** @param numeric-string $factor */
    public function multiply(string $factor): self
    {
        return new self(bcmul($this->amount, $factor, $this->precision));
    }
}
