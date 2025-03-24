<?php

namespace App\Domain\ValueObject;

use InvalidArgumentException;

class PhoneNumber
{
    private string $value;

    public function __construct(string $value)
    {
        // Validación: solo números, de 8 a 12 dígitos
        if (!preg_match('/^\d{8,12}$/', $value)) {
            throw new InvalidArgumentException(" Número de teléfono inválido: debe tener entre 8 y 12 dígitos numéricos sin caracteres especiales.");
        }

        $this->value = $value;
        echo " Número de teléfono válido: {$this->value}" . PHP_EOL;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
