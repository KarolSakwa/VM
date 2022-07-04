<?php

namespace VendingMachine;

use VendingMachine\Exception\InsufficientFundsException;
use VendingMachine\Exception\ItemNotFoundException;
use VendingMachine\Item\ItemCodeInterface;
use VendingMachine\Item\ItemCollection;
use VendingMachine\Item\ItemInterface;
use VendingMachine\Item\ItemA;
use VendingMachine\Item\ItemB;
use VendingMachine\Item\ItemC;
use VendingMachine\Money\MoneyCollectionInterface;
use VendingMachine\Money\MoneyCollection;
use VendingMachine\Money\MoneyInterface;

class VendingMachine implements VendingMachineInterface
{
    private ItemCollection $itemCollection;
    private MoneyCollection $insertedMoney;
    private MoneyCollection $currentTransactionMoney;

    public function __construct() {
        $this->itemCollection = new ItemCollection();
        $this->insertedMoney = new MoneyCollection();
        $this->currentTransactionMoney = new MoneyCollection();

        $itemA = new ItemA();
        $itemB = new ItemB();
        $itemC = new ItemC();

        $this->addItem($itemA);
        $this->addItem($itemB);
        $this->addItem($itemC);
    }

    public function addItem(ItemInterface $item): void
    {
        $this->itemCollection->add($item);
    }

    public function dropItem(ItemCodeInterface $itemCode): void
    {
        try {
            $itemClassName = '\VendingMachine\Item\Item' . $itemCode;
            $item = new $itemClassName();
            if ($item->getPrice() > $this->getCurrentTransactionMoney()->sum())
            {
                throw new InsufficientFundsException('This item is too expensive for you! Pick another one.' . PHP_EOL);
            }

            $selectedItem = $this->itemCollection->get($itemCode);
            $this->getCurrentTransactionMoney()->updateMoney($selectedItem->getPrice());
            $this->getInsertedMoney()->merge($this->getCurrentTransactionMoney());
        }
        catch (ItemNotFoundException $e) {
            echo $e->getMessage();
        }
    }

    public function insertMoney(MoneyInterface $money): void
    {
        $this->currentTransactionMoney->add($money);
    }

    public function getCurrentTransactionMoney(): MoneyCollectionInterface
    {
        return $this->currentTransactionMoney;
    }

    public function getInsertedMoney(): MoneyCollectionInterface
    {
        return $this->insertedMoney;
    }

    public function getItemCollection(): ItemCollection
    {
        return $this->itemCollection;
    }
}