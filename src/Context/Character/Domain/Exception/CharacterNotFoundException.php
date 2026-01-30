<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\Domain\Exception;

use ApiRol\Shared\Domain\Exception\DomainException;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Character\CharacterId;

class CharacterNotFoundException extends DomainException
{
    public static function forId(CharacterId $id)
    {
        return new static(sprintf('Entity of id %s of type %s was not found', $id->value(), get_class($id)));
    }
}
