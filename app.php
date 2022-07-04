<?php

require_once('vendor/autoload.php');

use VendingMachine\Exception\InvalidInputException;
use VendingMachine\Input\InputHandler;
use VendingMachine\VendingMachine;

$vendingMachine = new VendingMachine();

while (true) {
    $inputHandler = new InputHandler();
    try {
        $input = $inputHandler->getInput();
    }
    catch (InvalidInputException $e) {
        echo $e->getMessage();
        continue;
    }
    $action = $input->getAction();
    echo $action->handle($vendingMachine);
}