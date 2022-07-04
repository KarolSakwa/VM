<?php

namespace VendingMachine\Money;

class Dollar implements MoneyInterface
{

    public function getValue(): float
    {
        return 1;
    }

    public function getCode(): string
    {
        return 'DOLLAR';
    }
}