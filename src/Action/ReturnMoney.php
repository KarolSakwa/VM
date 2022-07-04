<?php

namespace VendingMachine\Action;

use VendingMachine\Response\Response;
use VendingMachine\Response\ResponseInterface;
use VendingMachine\VendingMachineInterface;

class ReturnMoney implements ActionInterface
{

    public function getName(): string
    {
        return 'RETURN-MONEY';
    }

    public function handle(VendingMachineInterface $vendingMachine): ResponseInterface
    {
        $change = $vendingMachine->getCurrentTransactionMoney()->sum() > 0 ? $vendingMachine->getCurrentTransactionMoney()->toString() : 'No money to return.';
        $vendingMachine->getCurrentTransactionMoney()->empty();
        return new Response($change . PHP_EOL);
    }
}