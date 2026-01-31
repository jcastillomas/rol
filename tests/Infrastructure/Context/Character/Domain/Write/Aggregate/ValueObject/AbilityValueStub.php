<?php

declare(strict_types=1);

namespace ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject;

use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability\AbilityValue;
use Faker\Factory;

final class AbilityValueStub
{
    public static function create(string $value): AbilityValue
    {
        return AbilityValue::fromString($value);
    }

    public static function random(): AbilityValue
    {
        $faker = Factory::create();

        return AbilityValue::fromString($faker->randomElement(['d6', 'd8', 'd10', 'd12', 'd20']));
    }
}
