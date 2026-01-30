<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\Infrastructure\Write\Persistence\Doctrine\MySQL\Type;

use ApiRol\Shared\Infrastructure\Persistence\Doctrine\MySQL\Type\IntegerType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Character\CharacterArmour;

final class CharacterArmourType extends IntegerType
{
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?int
    {
        return $value?->value();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): CharacterArmour
    {
        return CharacterArmour::fromInt($value);
    }

    public function getName(): string
    {
        return 'character_armour';
    }
}
