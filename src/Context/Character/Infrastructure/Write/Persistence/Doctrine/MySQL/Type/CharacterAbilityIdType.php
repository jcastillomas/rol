<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\Infrastructure\Write\Persistence\Doctrine\MySQL\Type;

use ApiRol\Context\Character\Domain\Write\Entity\ValueObject\CharacterAbilityId;
use ApiRol\Shared\Infrastructure\Persistence\Doctrine\MySQL\Type\UuidType;

final class CharacterAbilityIdType extends UuidType
{
    protected function specificUuidType(): string
    {
        return CharacterAbilityId::class;
    }

    public function getName(): string
    {
        return 'character_ability_id';
    }
}
