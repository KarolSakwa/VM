<?php

namespace VendingMachine\Input;

use TypeError;
use VendingMachine\Action\ActionInterface;
use VendingMachine\Money\MoneyCollection;
use VendingMachine\Money\MoneyCollectionInterface;

class Input implements InputInterface
{
    public string $actionClassName;

    public function __construct(string $actionClassName)
    {
        $this->actionClassName = $actionClassName;
    }

    public function getAction(): ActionInterface
    {
        return new $this->actionClassName();
    }

    public function getMoneyCollection(): MoneyCollectionInterface
    {
        return new MoneyCollection();
    }

}