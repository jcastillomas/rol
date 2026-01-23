<?php

declare(strict_types=1);

namespace ApiRol\Shared\UI\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use ApiRol\Shared\Application\Bus\Command\Command;
use ApiRol\Shared\Application\Bus\Command\CommandBusInterface;
use ApiRol\Shared\Application\Bus\Query\Query;
use ApiRol\Shared\Application\Bus\Query\QueryBusInterface;
use ApiRol\Shared\Application\Bus\Query\Response as QueryResponse;
use ApiRol\Shared\Application\Bus\Command\Response as CommandResponse;

abstract class ApiController extends AbstractController
{
    public function __construct(
        protected CommandBusInterface $commandBus,
        protected QueryBusInterface $queryBus,
    ) {
    }

    protected function dispatch(
        Command $command,
    ): void {
        $this->commandBus->dispatch($command);
    }

    protected function dispatchWithResponse(
        Command $command,
    ): ?CommandResponse {
        return $this->commandBus->dispatchWithResponse($command);
    }

    protected function ask(Query $query): ?QueryResponse
    {
        return $this->queryBus->ask($query);
    }
}
