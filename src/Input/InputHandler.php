<?php

namespace VendingMachine\Input;

use VendingMachine\Exception\InvalidInputException;

class InputHandler implements InputHandlerInterface
{
    private string $userInput;

    public function __construct()
    {
        $this->userInput = trim(readline('Input: '));
    }

    /**
     * @inheritDoc
     */
    public function getInput(): InputInterface
    {
        $userInputSanitized = str_replace(' ', '', ucwords(str_replace('-', ' ', $this->userInput))); // converts input to camelcase notation
        $actionClassName = '\VendingMachine\Action\\' . $userInputSanitized;
        if (!class_exists($actionClassName))
        {
            throw new InvalidInputException('Invalid input! Please try again.' . PHP_EOL);
        }

        return new Input($actionClassName);
    }
}