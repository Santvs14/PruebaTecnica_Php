<?php

namespace App\Application\User;

use App\Domain\User\Events\UserRegisteredEvent;
use Psr\Log\LoggerInterface;

class UserRegisteredEventHandler {
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger) {
        $this->logger = $logger;
    }

    public function handle(UserRegisteredEvent $event): void {
        // Aquí podrías enviar un correo de bienvenida, notificar a otros servicios, etc.
        $this->logger->info("Nuevo usuario registrado: " . $event->email()->value());
    }
}
