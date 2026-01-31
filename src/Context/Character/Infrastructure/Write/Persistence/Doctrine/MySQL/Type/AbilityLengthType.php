<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\Infrastructure\Write\Persistence\Doctrine\MySQL\Type;

use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability\AbilityLength;
use ApiRol\Shared\Infrastructure\Persistence\Doctrine\MySQL\Type\IntegerType;
use Doctrine\DBAL\Platforms\AbstractPlatform;

final class AbilityLengthType extends IntegerType
{
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?int
    {
        return $value?->value();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): AbilityLength
    {
        return AbilityLength::fromInt($value);
    }

    public function getAbilityLength(): string
    {
        return 'ability_length';
    }
}
