<?php

namespace App\Application\User;


use App\Domain\User\User;
use App\Domain\User\UserId;
use App\Domain\User\Name;
use App\Domain\User\Email;
use App\Domain\User\Password;
use App\Repository\UserRepository;
use App\Application\User\UserData; // IMPORTANTE: Agregar esta línea


class CreateUser
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(UserData $userData)
    {
        // Verificar si el usuario ya existe
        if ($this->userRepository->findByEmail($userData->getEmail())) {
            throw new \Exception("El usuario ya existe.");
        }

        $user = new User(
            new UserId(uniqid()), // Usar un ID único o autoincremental
            new Name($userData->getName()),
            new Email($userData->getEmail()),
            new Password($userData->getPassword()),
           // new Phone($userData->getPhone())
        );

        $this->userRepository->save($user);
        return $user;
    }
}
