<?php

declare(strict_types=1);

namespace ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject;

use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability\AbilityValueKind;
use Faker\Factory;

final class AbilityValueKindStub
{
    public static function create(?int $type = null): AbilityValueKind
    {
        $faker = Factory::create();

        return !empty($type) ? AbilityValueKind::from($type) : $faker->randomElement(AbilityValueKind::cases());
    }

    public static function random(): AbilityValueKind
    {
        return self::create();
    }
}
