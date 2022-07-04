<?php

namespace VendingMachine\Money;

class N implements MoneyInterface
{

    public function getValue(): float
    {
        return 0.05;
    }

    public function getCode(): string
    {
        return 'N';
    }
}