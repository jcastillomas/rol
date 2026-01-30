<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\Infrastructure\Write\Persistence\Doctrine\MySQL\Type;

use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Character\CharacterId;
use ApiRol\Shared\Infrastructure\Persistence\Doctrine\MySQL\Type\UuidType;

final class CharacterIdType extends UuidType
{
    protected function specificUuidType(): string
    {
        return CharacterId::class;
    }

    public function getName(): string
    {
        return 'character_id';
    }
}
