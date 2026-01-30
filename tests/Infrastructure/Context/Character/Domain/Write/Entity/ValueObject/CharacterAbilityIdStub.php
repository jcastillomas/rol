<?php

declare(strict_types=1);

namespace ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Entity\ValueObject;

use ApiRol\Context\Character\Domain\Write\Entity\ValueObject\CharacterAbilityId;

final class CharacterAbilityIdStub
{
    public static function random(): CharacterAbilityId
    {
        return CharacterAbilityId::generate();
    }
}
