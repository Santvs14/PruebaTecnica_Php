<?php
// src/Application/User/CreateUser.php

// src/Application/User/CreateUser.php

namespace App\Application\User;

use App\Domain\User\User;
use App\Domain\User\UserRepositoryInterface;
use App\Domain\User\UserData;

class CreateUser
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(UserData $data): User
    {
        // Lógica de negocio, como validar o manipular los datos antes de crear el usuario
        if (empty($data->getEmail())) {
            throw new \InvalidArgumentException("El correo electrónico es obligatorio.");
        }

        // Crear el objeto User (ahora pasando 4 argumentos)
        $user = new User(
            $data->getName(),
            $data->getEmail(),
            $data->getPassword(),
            new \DateTime()  // Cuarto argumento: fecha y hora actual
        );

        // Guardar el usuario usando el repositorio
        $this->userRepository->save($user);

        return $user;
    }
}
