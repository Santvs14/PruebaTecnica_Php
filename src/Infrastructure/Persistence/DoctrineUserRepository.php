<?php
// src/Infrastructure/Doctrine/DoctrineUserRepository.php

// src/Infrastructure/Repository/DoctrineUserRepository.php
// src/Infrastructure/Repository/DoctrineUserRepository.php
namespace App\Infrastructure\Repository;

use App\Domain\User\User;
use App\Domain\User\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineUserRepository implements UserRepositoryInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(User $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function findByEmail(string $email): ?User
    {
        return $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);
    }

    // Implementa el método findById
    public function findById(int $id): ?User
    {
        return $this->entityManager->getRepository(User::class)->find($id);
    }
}
