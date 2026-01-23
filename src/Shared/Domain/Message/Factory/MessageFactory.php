<?php

declare(strict_types=1);

namespace ApiRol\Shared\Domain\Message\Factory;

use ApiRol\Shared\Domain\Message\Message;

interface MessageFactory
{
    public function create(string $messageName, array $payload, array $metadata): Message;

    public function addMessagesToMap(array $messageClassNames): void;
}
