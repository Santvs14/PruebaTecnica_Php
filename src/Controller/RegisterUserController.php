<?php

namespace App\Infrastructure\Http;

use App\Application\User\RegisterUserUseCase;
use App\Application\User\RegisterUserRequest;

class RegisterUserController {
    private RegisterUserUseCase $useCase;

    public function __construct(RegisterUserUseCase $useCase) {
        $this->useCase = $useCase;
    }

    public function handle(array $requestData) {
        try {
            $this->useCase->execute(new RegisterUserRequest($requestData['name'], $requestData['email'], $requestData['password']));
            echo json_encode(["message" => "Usuario registrado exitosamente"]);
        } catch (\Exception $e) {
            echo json_encode(["error" => $e->getMessage()]);
        }
    }
}
