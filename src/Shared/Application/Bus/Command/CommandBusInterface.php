<?php

declare(strict_types=1);

namespace ApiRol\Shared\Application\Bus\Command;

interface CommandBusInterface
{
    public function dispatch(Command $command): void;
    public function dispatchWithResponse(Command $command): ?Response;
}
