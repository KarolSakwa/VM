<?php

namespace VendingMachine\Action;

use VendingMachine\Response\Response;
use VendingMachine\Response\ResponseInterface;
use VendingMachine\VendingMachineInterface;

abstract class MoneyCollector implements ActionInterface
{

    public function getName(): string
    {
        return '';
    }

    public function handle(VendingMachineInterface $vendingMachine): ResponseInterface
    {
        $moneyCollectorClass = "\VendingMachine\Money\\" . $this->getName();
        $vendingMachine->insertMoney(new $moneyCollectorClass);
        $currentTransactionMoney = $vendingMachine->getCurrentTransactionMoney();
        $currentTransactionMoneyString = '(' . $currentTransactionMoney->toString() . ')';
        $currentBalance = number_format($currentTransactionMoney->sum(), 2);

        return new Response('Current balance: ' . $currentBalance . ' '. $currentTransactionMoneyString . PHP_EOL);
    }
}