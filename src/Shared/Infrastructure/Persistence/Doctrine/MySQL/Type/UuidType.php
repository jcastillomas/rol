<?php

declare(strict_types=1);

namespace ApiRol\Shared\Infrastructure\Persistence\Doctrine\MySQL\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use ApiRol\Shared\Domain\ValueObject\Uuid;

class UuidType extends StringType
{
    public function convertToPHPValue($value, AbstractPlatform $platform): ?Uuid
    {
        if (is_null($value)) {
            return null;
        }

        $specificUuidType = $this->specificUuidType();

        return $specificUuidType::fromString($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        return !is_null($value) ? $value->value(): null;
    }

    protected function specificUuidType(): string
    {
        return Uuid::class;
    }

    public function getName(): string
    {
        return 'uuid';
    }
}
