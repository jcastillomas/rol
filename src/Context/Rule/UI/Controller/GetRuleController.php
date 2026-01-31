<?php

declare(strict_types=1);

namespace ApiRol\Context\Rule\UI\Controller;

use ApiRol\Context\Rule\Application\Query\FindRule\FindRuleQuery;
use ApiRol\Context\Rule\Application\Query\FindRule\FindRuleQueryResponse;
use ApiRol\Context\Rule\Domain\Write\Exception\RuleNotFoundException;
use ApiRol\Context\Rule\UI\Controller\Transformer\RuleResponseTransformer;
use ApiRol\Shared\Application\Bus\Command\CommandBusInterface;
use ApiRol\Shared\Application\Bus\Query\QueryBusInterface;
use ApiRol\Shared\UI\Controller\ApiController;
use ApiRol\Shared\UI\Response\ApiHttpErrorResponse;
use ApiRol\Shared\UI\Response\ApiHttpResponse;
use ApiRol\Shared\UI\Response\HttpResponseCode;
use Symfony\Component\HttpFoundation\Request;

final class GetRuleController extends ApiController
{
    public function __construct(
        CommandBusInterface $commandBus,
        QueryBusInterface $queryBus,
        private RuleResponseTransformer $transformer
    ) {
        parent::__construct($commandBus, $queryBus);
    }

    public function __invoke(Request $request, string $ruleId): ApiHttpResponse
    {
        try {
            /** @var FindRuleQueryResponse $queryResponse */
            $queryResponse = $this->queryBus->ask(FindRuleQuery::create(
                $ruleId,
            ));
        } catch (RuleNotFoundException $e) {
            return ApiHttpErrorResponse::uniqueError($e->getMessage(), HttpResponseCode::HTTP_NOT_FOUND);
        }

        return new ApiHttpResponse($this->transformer->transform($queryResponse));
    }
}
