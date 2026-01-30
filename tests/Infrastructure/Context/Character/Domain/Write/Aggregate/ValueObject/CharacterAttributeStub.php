<?php

declare(strict_types=1);

namespace ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject;

use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Character\CharacterAttribute;
use Faker\Factory;

final class CharacterAttributeStub
{
    public static function create(?int $value = null): CharacterAttribute
    {
        $faker = Factory::create();

        return CharacterAttribute::fromInt($value ?? $faker->numberBetween(1, 10));
    }

    public static function random(): CharacterAttribute
    {
        return self::create();
    }
}
