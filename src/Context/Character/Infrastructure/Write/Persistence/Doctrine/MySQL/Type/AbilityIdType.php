<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\Infrastructure\Write\Persistence\Doctrine\MySQL\Type;

use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability\AbilityId;
use ApiRol\Shared\Infrastructure\Persistence\Doctrine\MySQL\Type\UuidType;

final class AbilityIdType extends UuidType
{
    protected function specificUuidType(): string
    {
        return AbilityId::class;
    }

    public function getName(): string
    {
        return 'ability_id';
    }
}
