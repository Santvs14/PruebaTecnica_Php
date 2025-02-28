<?php

// src/Domain/User/Name.php
namespace App\Domain\User;

class Name
{
    private $value;

    public function __construct(string $value)
    {
        if (strlen($value) < 3 || !preg_match("/^[a-zA-Z\s]+$/", $value)) {
            throw new \InvalidArgumentException("Invalid name format.");
        }
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
