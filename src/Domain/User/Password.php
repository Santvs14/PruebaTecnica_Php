<?php

namespace App\Domain\User;

use InvalidArgumentException;

class Password {
    private string $hash;

    public function __construct(string $plainPassword) {
        if (strlen($plainPassword) < 8 || !preg_match('/[A-Z]/', $plainPassword) || !preg_match('/\d/', $plainPassword)) {
            throw new InvalidArgumentException("La contraseña no cumple con los requisitos.");
        }
        $this->hash = password_hash($plainPassword, PASSWORD_BCRYPT);
    }

    public function hash(): string { return $this->hash; }



    public function verify(string $plainPassword): bool {
        return password_verify($plainPassword, $this->hash);
    }
    
}
