<?php

declare(strict_types=1);

namespace ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject;

use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability\AbilityLength;
use Faker\Factory;

final class AbilityLengthStub
{
    public static function create(int $value): AbilityLength
    {
        return AbilityLength::fromInt($value);
    }

    public static function random(): AbilityLength
    {
        $faker = Factory::create();

        return AbilityLength::fromInt($faker->numberBetween(5, 100));
    }
}
