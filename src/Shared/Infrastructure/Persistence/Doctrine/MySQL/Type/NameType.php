<?php

declare(strict_types=1);

namespace ApiRol\Shared\Infrastructure\Persistence\Doctrine\MySQL\Type;

use ApiRol\Shared\Domain\ValueObject\Name;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class NameType extends StringType
{
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (null === $value) {
            return null;
        }

        return $value->value();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Name
    {
        if (null === $value) {
            return null;
        }

        return Name::fromString($value);
    }

    public function getName(): string
    {
        return 'name';
    }
}
