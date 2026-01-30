<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\Domain\Exception;

use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Equipment\EquipmentId;
use ApiRol\Shared\Domain\Exception\DomainException;

class EquipmentNotFoundException extends DomainException
{
    public static function forId(EquipmentId $id)
    {
        return new static(sprintf('Entity of id %s of type %s was not found', $id->value(), get_class($id)));
    }
}
