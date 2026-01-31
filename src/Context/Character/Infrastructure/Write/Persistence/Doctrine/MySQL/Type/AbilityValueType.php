<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\Infrastructure\Write\Persistence\Doctrine\MySQL\Type;

use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability\AbilityValue;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class AbilityValueType extends StringType
{
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (null === $value) {
            return null;
        }

        return $value->value();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?AbilityValue
    {
        if (null === $value) {
            return null;
        }

        return AbilityValue::fromString($value);
    }

    public function getAbilityValue(): string
    {
        return 'ability_value';
    }
}
