<?php


namespace VendingMachine\Item;


class ItemA implements ItemInterface
{

    public function getPrice(): float
    {
        return 0.65;
    }

    public function getCount(): int
    {
        return 1;
    }

    public function getCode(): ItemCodeInterface
    {
        return new ItemCode('A');
    }
}