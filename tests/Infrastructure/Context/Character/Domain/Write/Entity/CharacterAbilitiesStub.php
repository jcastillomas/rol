<?php

declare(strict_types=1);

namespace ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Entity;


use ApiRol\Context\Character\Domain\Write\Entity\CharacterAbilities;
use ApiRol\Context\Character\Domain\Write\Entity\CharacterAbility;

final class CharacterAbilitiesStub
{
    public static function create(
        CharacterAbility ...$prescriptionItems
    ): CharacterAbilities {
        return CharacterAbilities::create($prescriptionItems);
    }

    public static function random(?int $numItems = 2): CharacterAbilities
    {
        $prescriptionIterations = [];
        for ($i = 0; $i < $numItems; $i++) {
            $prescriptionIterations[] = CharacterAbilityStub::random();
        }

        return self::create(...$prescriptionIterations);
    }
}
