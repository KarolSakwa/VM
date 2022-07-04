<?php


namespace VendingMachine\Item;


class ItemCode implements ItemCodeInterface
{
    private $itemCode;

    public function __construct(string $itemCode) {
        $this->itemCode = $itemCode;
    }

    public function __toString(): string
    {
        return $this->itemCode;
    }
}