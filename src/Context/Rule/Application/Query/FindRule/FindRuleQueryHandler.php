<?php

declare(strict_types=1);

namespace ApiRol\Context\Rule\Application\Query\FindRule;

use ApiRol\Context\Rule\Domain\Write\Repository\RuleRepository;
use ApiRol\Shared\Application\Bus\Query\QueryHandlerInterface;

final class FindRuleQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private RuleRepository $repository,
        private FindRuleQueryResponseConverter $responseConverter
    ) {
    }

    public function __invoke(FindRuleQuery $query): FindRuleQueryResponse
    {
        $rule = $this->repository->find($query->ruleId());

        return $this->responseConverter->__invoke($rule);
    }
}
