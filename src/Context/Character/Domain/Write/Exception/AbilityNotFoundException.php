<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\Domain\Write\Exception;

use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability\AbilityId;
use ApiRol\Shared\Domain\Exception\DomainException;

class AbilityNotFoundException extends DomainException
{
    public static function forId(AbilityId $id)
    {
        return new static(sprintf('Entity of id %s of type %s was not found', $id->value(), get_class($id)));
    }
}
