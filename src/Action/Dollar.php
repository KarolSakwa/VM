<?php

namespace VendingMachine\Action;

class Dollar extends MoneyCollector
{
    public function getName(): string
    {
        return 'DOLLAR';
    }
}