<?php
// src/Controller/UserController.php

namespace App\Controller;

use App\Application\User\CreateUser;
use App\Domain\User\UserData;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController
{
    private $createUser;

    public function __construct(CreateUser $createUser)
    {
        $this->createUser = $createUser;
    }

    public function create(Request $request): Response
    {
        // Obtener los datos del usuario desde la solicitud HTTP
        $name = $request->get('name');
        $email = $request->get('email');
        $password = $request->get('password');

        // Crear un objeto UserData
        $userData = new UserData($name, $email, $password);

        try {
            // Llamar al caso de uso para crear un usuario
            $user = $this->createUser->execute($userData);

            return new Response('Usuario creado con éxito!', Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return new Response('Error: ' . $e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
