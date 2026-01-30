<?php

declare(strict_types=1);

namespace ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject;

use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability\AbilityId;

final class AbilityIdStub
{
    public static function random(): AbilityId
    {
        return AbilityId::generate();
    }
}
