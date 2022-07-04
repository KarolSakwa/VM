<?php

namespace VendingMachine\Money;

class Q implements MoneyInterface
{

    public function getValue(): float
    {
        return 0.25;
    }

    public function getCode(): string
    {
        return 'Q';
    }
}