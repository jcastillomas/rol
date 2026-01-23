<?php

declare(strict_types=1);

namespace ApiRol\Shared\Application\Bus\Query;

interface QueryBusInterface
{
    public function ask(Query $query): ?Response;
}
