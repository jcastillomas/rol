<?php

declare(strict_types=1);

namespace ApiRol\Shared\Domain\Write\Exception;

use ApiRol\Shared\Domain\ValueObject\Id;

class EntityNotFoundException extends \Exception
{
    public static function forId(Id $id)
    {
        return new static(sprintf('Entity of id %s of type %s was not found', $id->value(), get_class($id)));
    }
}
