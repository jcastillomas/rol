<?php

declare(strict_types=1);

namespace ApiRol\Tests\Infrastructure\Shared\Domain\ValueObject;

use ApiRol\Shared\Domain\ValueObject\Name;
use Faker\Factory;

final class NameStub
{
    public static function create(string $name): Name
    {
        return Name::fromString($name);
    }

    public static function random(): Name
    {
        $faker = Factory::create();

        return Name::fromString($faker->name());
    }
}
