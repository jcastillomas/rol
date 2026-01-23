<?php

declare(strict_types=1);

namespace ApiRol\Context\Rule\Application\Query\FindRule;

use ApiRol\Context\Rule\Domain\Write\Aggregate\Rule;

final class FindRuleQueryResponseConverter
{
    public function __invoke(Rule $doctor): FindRuleQueryResponse
    {
        return new FindRuleQueryResponse([
            FindRuleQueryResponse::ID => $doctor->id()->value(),
        ]);
    }
}
