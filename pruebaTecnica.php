<?php

// src/Domain/ValueObject/UserId.php
namespace App\Domain\ValueObject;

class UserId {
    private string $id;

    public function __construct(string $id) {
        if (!preg_match('/^[a-f0-9]{32}$/', $id)) {
            throw new \InvalidArgumentException('Invalid UUID format');
        }
        $this->id = $id;
    }

    public function getId(): string {
        return $this->id;
    }
}

// src/Domain/ValueObject/Email.php
namespace App\Domain\ValueObject;

class Email {
    private string $email;

    public function __construct(string $email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Invalid email format');
        }
        $this->email = $email;
    }

    public function getEmail(): string {
        return $this->email;
    }
}

// src/Domain/ValueObject/Password.php
namespace App\Domain\ValueObject;

class Password {
    private string $hash;

    public function __construct(string $password) {
        if (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password)) {
            throw new \InvalidArgumentException('Weak password');
        }
        $this->hash = password_hash($password, PASSWORD_BCRYPT);
    }

    public function getHash(): string {
        return $this->hash;
    }
}

// src/Domain/Entity/User.php
namespace App\Domain\Entity;

use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\Password;
use DateTime;

class User {
    private UserId $id;
    private string $name;
    private Email $email;
    private Password $password;
    private DateTime $createdAt;

    public function __construct(UserId $id, string $name, Email $email, Password $password) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->createdAt = new DateTime();
    }
}

// src/Application/UseCase/RegisterUserUseCase.php
namespace App\Application\UseCase;

use App\Domain\Entity\User;
use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\Password;
use App\Domain\Event\UserRegisteredEvent;
use App\Infrastructure\Repository\UserRepositoryInterface;

class RegisterUserUseCase {
    private UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function execute(string $name, string $email, string $password): User {
        $userId = new UserId(bin2hex(random_bytes(16)));
        $userEmail = new Email($email);
        $userPassword = new Password($password);

        if ($this->repository->findByEmail($userEmail)) {
            throw new \Exception('User already exists');
        }

        $user = new User($userId, $name, $userEmail, $userPassword);
        $this->repository->save($user);

        // Dispatch domain event
        event(new UserRegisteredEvent($user));

        return $user;
    }
}

// src/Infrastructure/Repository/UserRepositoryInterface.php
namespace App\Infrastructure\Repository;

use App\Domain\Entity\User;
use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\Email;

interface UserRepositoryInterface {
    public function save(User $user): void;
    public function findById(UserId $id): ?User;
    public function findByEmail(Email $email): ?User;
}

// docker-compose.yml
version: '3.8'
;services:
  php:
    build: ./docker/php
    container_name: php_app
    volumes:
      - .:/var/www/html
    depends_on:
      - mysql

  mysql:
    image: mysql:8
    container_name: mysql_db
    restart: always
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: app_db
      MYSQL_USER: user
      MYSQL_PASSWORD: password
    ports:
      - "3306:3306"
    volumes:
      - mysql_data:/var/lib/mysql

volumes:
  mysql_data:

// Makefile
.PHONY: start stop test

start:
	docker-compose up -d

stop:
	docker-compose down

test:
	docker exec php_app vendor/bin/phpunit
