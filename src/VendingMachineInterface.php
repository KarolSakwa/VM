<?php

namespace VendingMachine;

use VendingMachine\Item\ItemCodeInterface;
use VendingMachine\Item\ItemInterface;
use VendingMachine\Money\MoneyCollectionInterface;
use VendingMachine\Money\MoneyInterface;

interface VendingMachineInterface
{
    public function addItem(ItemInterface $item): void;
    public function dropItem(ItemCodeInterface $itemCode): void;
    public function insertMoney(MoneyInterface $money): void;
    public function getCurrentTransactionMoney(): MoneyCollectionInterface;
    public function getInsertedMoney(): MoneyCollectionInterface;
}
