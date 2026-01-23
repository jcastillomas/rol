<?php

declare(strict_types=1);

namespace ApiRol\Tests\Infrastructure\Context\Rule\Domain\Write\Aggregate\ValueObject;

use ApiRol\Context\Rule\Domain\Write\Aggregate\ValueObject\RuleId;

final class RuleIdStub
{
    public static function random(): RuleId
    {
        return RuleId::generate();
    }
}
