<?php

declare(strict_types=1);

namespace ApiRol\Context\Rule\Domain\Write\Repository;

use ApiRol\Context\Rule\Domain\Write\Aggregate\Rule;
use ApiRol\Context\Rule\Domain\Write\Aggregate\ValueObject\RuleId;

interface RuleRepository
{
    public function save(Rule $rule): void;
    public function find(RuleId $id): Rule;
}
