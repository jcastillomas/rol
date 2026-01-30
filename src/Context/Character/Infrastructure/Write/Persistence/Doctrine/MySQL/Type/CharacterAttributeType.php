<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\Infrastructure\Write\Persistence\Doctrine\MySQL\Type;

use ApiRol\Shared\Infrastructure\Persistence\Doctrine\MySQL\Type\IntegerType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Character\CharacterAttribute;

final class CharacterAttributeType extends IntegerType
{
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?int
    {
        return $value?->value();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): CharacterAttribute
    {
        return CharacterAttribute::fromInt($value);
    }

    public function getName(): string
    {
        return 'character_attribute';
    }
}
