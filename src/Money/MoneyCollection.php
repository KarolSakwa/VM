<?php

namespace VendingMachine\Money;

class MoneyCollection implements MoneyCollectionInterface
{
    private array $money;

    public function __construct()
    {
        $this->money = array();
    }

    public function add(MoneyInterface $money): void
    {
        $this->money[] = $money;
    }

    public function sum(): float
    {
        $sum = 0;
        foreach ($this->money as $money) {
            $sum += $money->getValue();
        }
        return $sum;
    }

    public function merge(MoneyCollectionInterface $moneyCollection): void
    {
        $this->money = array_merge($this->money, $moneyCollection->money);
    }

    public function empty(): void
    {
        $this->money = array();
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return $this->money;
    }

    public function updateMoney(float $amount): void
    {
        $nickel = new N();
        $dime = new D();
        $quarter = new Q();
        $dollar = new Dollar();

        $denominations = array($dollar, $quarter, $dime, $nickel);

        $change = $this->sum() - $amount;
        $result = array();

        foreach ($denominations as $denomination)
        {
            if ($change > $denomination->getValue() || abs(($change-$denomination->getValue()) / $denomination->getValue()) < 0.00001) // float comparison issue
            {
                $result[] = $denomination;
                $change -= $denomination->getValue();
            }
        }
        $this->money = $result;
    }

    public function toString(): string
    {
        $moneyArr = [];
        foreach($this->money as $money) {
            $moneyArr[] = $money->getCode();
        }

        return implode(', ', $moneyArr);
    }
}