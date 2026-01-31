<?php

declare(strict_types=1);

namespace ApiRol\Context\Rule\Application\Query\FindRule;

use ApiRol\Context\Rule\Domain\Write\Aggregate\Rule;

final class FindRuleQueryResponseConverter
{
    public function __invoke(Rule $rule): FindRuleQueryResponse
    {
        return new FindRuleQueryResponse([
            FindRuleQueryResponse::ID => $rule->id()->value(),
        ]);
    }
}
