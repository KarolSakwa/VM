<?php

namespace VendingMachine\Response;

class Response implements ResponseInterface
{
    private string $response;

    public function __construct($response)
    {
        $this->response = $response;
    }

    public function __toString(): string
    {
        return $this->response;
    }
}