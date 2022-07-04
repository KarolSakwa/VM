<?php


namespace VendingMachine\Item;


use VendingMachine\Exception\ItemNotFoundException;
use VendingMachine\Input\InputHandler;

class ItemCollection implements ItemCollectionInterface
{
    public array $items;

    public function __construct()
    {
        $this->items = array();
    }

    public function add(ItemInterface $item): void
    {
        $this->items[] = $item;
    }

    /**
     * @inheritDoc
     */
    public function get(ItemCodeInterface $itemCode): ItemInterface
    {
            if ($this->count($itemCode) == 0)
            {
                throw new ItemNotFoundException('Item not found. Please choose another item.' . PHP_EOL);
            }
            foreach ($this->items as $item) {
                if ($item->getCode() == $itemCode) {
                    $selectedItem = $this->items[array_search($item, $this->items)];
                    unset($this->items[array_search($item, $this->items)]);
                    break;
                }
            }

        return $selectedItem;
    }

    public function count(ItemCodeInterface $itemCode): int
    {
        $count = 0;
        foreach ($this->items as $item) {
            if ($item->getCode() == $itemCode) {
                $count ++;
            }
        }
        return $count;
    }

    public function empty(): void
    {
        $this->items = array();
    }
}