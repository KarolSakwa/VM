<?php

namespace VendingMachine\Action;

use VendingMachine\Exception\InsufficientFundsException;
use VendingMachine\Item\ItemCode;
use VendingMachine\Response\Response;
use VendingMachine\Response\ResponseInterface;
use VendingMachine\VendingMachineInterface;

abstract class ItemGetter implements ActionInterface
{

    public function getName(): string
    {
        return '';
    }

    public function handle(VendingMachineInterface $vendingMachine): ResponseInterface
    {
        $itemCount = $vendingMachine->getItemCollection()->count(new ItemCode($this->getName()));
        try {
            $soldItem = new ItemCode($this->getName());
            $vendingMachine->dropItem($soldItem);
        }
        catch (InsufficientFundsException $e) {
            $soldItem = null;
            echo $e->getMessage();
        }
        if($itemCount > 0 && !empty($soldItem)) return new Response($this->getName() . PHP_EOL);
        return new Response('');
    }
}