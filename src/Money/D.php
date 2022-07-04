<?php

namespace VendingMachine\Money;

class D implements MoneyInterface
{

    public function getValue(): float
    {
        return 0.1;
    }

    public function getCode(): string
    {
        return 'D';
    }
}