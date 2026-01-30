<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\Domain\Write\Entity;

use ApiRol\Shared\Domain\TypedCollection;

class CharacterAbilities extends TypedCollection
{
    protected function type(): string
    {
        return CharacterAbility::class;
    }
}
