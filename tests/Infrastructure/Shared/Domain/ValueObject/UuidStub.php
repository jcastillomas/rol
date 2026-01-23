<?php

declare(strict_types=1);

namespace ApiRol\Tests\Infrastructure\Shared\Domain\ValueObject;

use ApiRol\Shared\Domain\Service\UuidGenerator;
use ApiRol\Shared\Domain\ValueObject\Uuid;

final class UuidStub
{
    public static function random(): Uuid
    {
        return UuidGenerator::generate();
    }
}
