<?php

declare(strict_types=1);

namespace ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject;

use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Character\CharacterId;

final class CharacterIdStub
{
    public static function random(): CharacterId
    {
        return CharacterId::generate();
    }
}
