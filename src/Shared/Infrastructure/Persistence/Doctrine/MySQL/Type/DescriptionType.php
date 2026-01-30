<?php

declare(strict_types=1);

namespace ApiRol\Shared\Infrastructure\Persistence\Doctrine\MySQL\Type;

use ApiRol\Shared\Domain\ValueObject\Description;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class DescriptionType extends StringType
{
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (null === $value) {
            return null;
        }

        return $value->value();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Description
    {
        if (null === $value) {
            return null;
        }

        return Description::fromString($value);
    }

    public function getDescription(): string
    {
        return 'description';
    }
}
