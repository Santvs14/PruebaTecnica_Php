<?php


// src/Container.php
// src/Container.php
use DI\ContainerBuilder;
use App\Domain\User\UserRepositoryInterface; // Asegúrate de importar la interfaz
use App\Infrastructure\Repository\DoctrineUserRepository; // Asegúrate de importar la implementación del repositorio
use App\Application\User\CreateUser; // Asegúrate de importar el caso de uso

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions([
    UserRepositoryInterface::class => \DI\create(DoctrineUserRepository::class),
    CreateUser::class => \DI\autowire(),
]);

$container = $containerBuilder->build();
