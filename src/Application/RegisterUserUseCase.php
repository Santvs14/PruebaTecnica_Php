
<?php

namespace App\Application\User;

use App\Domain\User\User;
use App\Domain\User\UserId;
use App\Domain\User\Name;
use App\Domain\User\Email;
use App\Domain\User\Password;
use App\Domain\User\UserRepositoryInterface;
use InvalidArgumentException;

class RegisterUserUseCase {
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function execute(RegisterUserRequest $request): void {
        if ($this->userRepository->findById(new Email($request->email()))) {
            throw new InvalidArgumentException("El email ya está en uso.");
        }

        $user = new User(
            new UserId(),
            new Name($request->name()),
            new Email($request->email()),
            new Password($request->password())
        );

        $this->userRepository->save($user);
    }
}
