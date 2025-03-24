<?php

require_once __DIR__ . '/src/Domain/ValueObject/PhoneNumber.php';

use App\Domain\ValueObject\PhoneNumber;

try {
    $telefono = new PhoneNumber('8095603456#'); // Número válido
} catch (InvalidArgumentException $e) {
    echo 'Error: ' . $e->getMessage() . PHP_EOL;
}

try {
   // $telefonoInvalido = new PhoneNumber('80912'); // Número inválido
} catch (InvalidArgumentException $e) {
    echo 'Error: ' . $e->getMessage() . PHP_EOL;
}
