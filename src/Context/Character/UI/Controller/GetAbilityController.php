<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\UI\Controller;

use ApiRol\Context\Character\Application\Query\FindAbility\FindAbilityQuery;
use ApiRol\Context\Character\Application\Query\FindAbility\FindAbilityQueryResponse;
use ApiRol\Context\Character\Domain\Write\Exception\AbilityNotFoundException;
use ApiRol\Context\Character\UI\Controller\Transformer\AbilityResponseTransformer;
use ApiRol\Shared\Application\Bus\Command\CommandBusInterface;
use ApiRol\Shared\Application\Bus\Query\QueryBusInterface;
use ApiRol\Shared\UI\Controller\ApiController;
use ApiRol\Shared\UI\Response\ApiHttpErrorResponse;
use ApiRol\Shared\UI\Response\ApiHttpResponse;
use ApiRol\Shared\UI\Response\HttpResponseCode;
use Symfony\Component\HttpFoundation\Request;

final class GetAbilityController extends ApiController
{
    public function __construct(
        CommandBusInterface $commandBus,
        QueryBusInterface $queryBus,
        private AbilityResponseTransformer $transformer
    ) {
        parent::__construct($commandBus, $queryBus);
    }

    public function __invoke(Request $request, string $abilityId): ApiHttpResponse
    {
        try {
            /** @var FindAbilityQueryResponse $queryResponse */
            $queryResponse = $this->queryBus->ask(FindAbilityQuery::create(
                $abilityId,
            ));
        } catch (AbilityNotFoundException $e) {
            return ApiHttpErrorResponse::uniqueError($e->getMessage(), HttpResponseCode::HTTP_NOT_FOUND);
        }

        return new ApiHttpResponse($this->transformer->transform($queryResponse));
    }
}
