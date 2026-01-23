<?php

declare(strict_types=1);

namespace ApiRol\Context\Rule\Infrastructure\Write\Persistence\Doctrine\MySQL\Type;

use ApiRol\Context\Rule\Domain\Write\Aggregate\ValueObject\RuleId;
use ApiRol\Shared\Infrastructure\Persistence\Doctrine\MySQL\Type\UuidType;

final class RuleIdType extends UuidType
{
    protected function specificUuidType(): string
    {
        return RuleId::class;
    }

    public function getName(): string
    {
        return 'rule_id';
    }
}
