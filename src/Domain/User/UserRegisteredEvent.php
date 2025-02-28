// src/Domain/User/UserRegisteredEvent.php

<?php

namespace App\Domain\User;


class UserRegisteredEvent
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
