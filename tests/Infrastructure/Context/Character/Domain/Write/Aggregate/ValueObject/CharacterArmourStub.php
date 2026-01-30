<?php

declare(strict_types=1);

namespace ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject;

use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Character\CharacterArmour;
use Faker\Factory;

final class CharacterArmourStub
{
    public static function create(?int $value = null): CharacterArmour
    {
        $faker = Factory::create();

        return CharacterArmour::fromInt($value ?? $faker->numberBetween(1, 100));
    }

    public static function random(): CharacterArmour
    {
        return self::create();
    }
}
