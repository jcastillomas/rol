<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\Infrastructure\Write\Persistence\Doctrine\MySQL\Repository;

use ApiRol\Context\Character\Domain\Write\Aggregate\CharacterBase;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Character\CharacterId;
use ApiRol\Context\Character\Domain\Write\Exception\CharacterNotFoundException;
use ApiRol\Context\Character\Domain\Write\Repository\CharacterRepository;
use ApiRol\Shared\Domain\Write\Exception\AggregateNotFoundException;
use ApiRol\Shared\Infrastructure\Persistence\Doctrine\MySQL\Repository\AggregateRepository;

final class DoctrineCharacterRepository extends AggregateRepository implements CharacterRepository
{
    public function save(CharacterBase $character): void
    {
        $this->saveAggregate($character);
    }

    public function find(CharacterId $id): CharacterBase
    {
        try {
            return $this->doFind($id);
        } catch (AggregateNotFoundException $e) {
            throw CharacterNotFoundException::forId($id);
        }
    }

    protected function entityClassName(): string
    {
        return CharacterBase::class;
    }
}
