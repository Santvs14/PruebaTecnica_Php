<?php
// src/Domain/User/UserRepositoryInterface.php

namespace App\Domain\User;

interface UserRepositoryInterface
{
    public function findById(int $id): ?User; // Buscar un usuario por su ID
    public function save(User $user): void;  // Guardar un usuario
    public function findByEmail(string $email): ?User; // Buscar un usuario por su email
}
