<?php

declare(strict_types=1);

namespace ApiRol\Tests\Infrastructure\Shared\Domain\ValueObject;

use ApiRol\Shared\Domain\ValueObject\Description;
use Faker\Factory;

final class DescriptionStub
{
    public static function create(string $name): Description
    {
        return Description::fromString($name);
    }

    public static function random(): Description
    {
        $faker = Factory::create();

        return Description::fromString($faker->realTextBetween());
    }
}
