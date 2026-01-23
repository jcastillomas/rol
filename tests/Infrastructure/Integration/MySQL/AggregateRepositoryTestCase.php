<?php

declare(strict_types=1);

namespace ApiRol\Tests\Infrastructure\Integration\MySQL;

use ApiRol\Shared\Infrastructure\Persistence\Doctrine\MySQL\Repository\AggregateRepository;

abstract class AggregateRepositoryTestCase extends RepositoryTestCase
{
    protected AggregateRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = $this->repository();
        $this->purge();
    }

    abstract protected function repository(): AggregateRepository;
}
