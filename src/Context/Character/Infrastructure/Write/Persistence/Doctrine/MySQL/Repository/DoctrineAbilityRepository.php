<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\Infrastructure\Write\Persistence\Doctrine\MySQL\Repository;

use ApiRol\Context\Character\Domain\Write\Aggregate\Ability;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability\AbilityId;
use ApiRol\Context\Character\Domain\Write\Exception\AbilityNotFoundException;
use ApiRol\Context\Character\Domain\Write\Repository\AbilityRepository;
use ApiRol\Shared\Domain\Write\Exception\AggregateNotFoundException;
use ApiRol\Shared\Infrastructure\Persistence\Doctrine\MySQL\Repository\AggregateRepository;

final class DoctrineAbilityRepository extends AggregateRepository implements AbilityRepository
{
    public function save(Ability $ability): void
    {
        $this->saveAggregate($ability);
    }

    public function find(AbilityId $id): Ability
    {
        try {
            return $this->doFind($id);
        } catch (AggregateNotFoundException $e) {
            throw AbilityNotFoundException::forId($id);
        }
    }

    protected function entityClassName(): string
    {
        return Ability::class;
    }
}
