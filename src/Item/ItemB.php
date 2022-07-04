<?php


namespace VendingMachine\Item;


class ItemB implements ItemInterface
{

    public function getPrice(): float
    {
        return 1;
    }

    public function getCount(): int
    {
        return 1;
    }

    public function getCode(): ItemCodeInterface
    {
        return new ItemCode('B');
    }
}