// src/Application/UserResponseDTO.php

<?php

namespace App\Application;

use App\Domain\User\User;

class UserResponseDTO
{
    public $id;
    public $name;
    public $email;
    public $createdAt;

    public function __construct(User $user)
    {
        $this->id = $user->getId()->getValue();
        $this->name = $user->getName()->getValue();
        $this->email = $user->getEmail()->getValue();
        $this->createdAt = $user->getCreatedAt()->format('Y-m-d H:i:s');
    }
}
