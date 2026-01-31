<?php

declare(strict_types=1);

namespace ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject;

use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability\AbilityTargetKind;
use Faker\Factory;

final class AbilityTargetKindStub
{
    public static function create(?int $type = null): AbilityTargetKind
    {
        $faker = Factory::create();

        return !empty($type) ? AbilityTargetKind::from($type) : $faker->randomElement(AbilityTargetKind::cases());
    }

    public static function random(): AbilityTargetKind
    {
        return self::create();
    }
}
