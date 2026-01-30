<?php

declare(strict_types=1);

namespace ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject;

use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Character\CharacterLife;
use Faker\Factory;

final class CharacterLifeStub
{
    public static function create(?int $value = null): CharacterLife
    {
        $faker = Factory::create();

        return CharacterLife::fromInt($value ?? $faker->numberBetween(1, 1000));
    }

    public static function random(): CharacterLife
    {
        return self::create();
    }
}
