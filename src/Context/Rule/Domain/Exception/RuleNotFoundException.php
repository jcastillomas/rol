<?php

declare(strict_types=1);

namespace ApiRol\Context\Rule\Domain\Exception;

use ApiRol\Context\Rule\Domain\Write\Aggregate\ValueObject\RuleId;
use ApiRol\Shared\Domain\Exception\DomainException;

class RuleNotFoundException extends DomainException
{
    public static function forId(RuleId $id)
    {
        return new static(sprintf('Entity of id %s of type %s was not found', $id->value(), get_class($id)));
    }
}
