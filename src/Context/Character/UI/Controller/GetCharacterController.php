<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\UI\Controller;

use ApiRol\Context\Character\Application\Query\FindCharacter\FindCharacterQuery;
use ApiRol\Context\Character\Application\Query\FindCharacter\FindCharacterQueryResponse;
use ApiRol\Context\Character\Domain\Write\Exception\CharacterNotFoundException;
use ApiRol\Context\Character\UI\Controller\Transformer\CharacterResponseTransformer;
use ApiRol\Shared\Application\Bus\Command\CommandBusInterface;
use ApiRol\Shared\Application\Bus\Query\QueryBusInterface;
use ApiRol\Shared\UI\Controller\ApiController;
use ApiRol\Shared\UI\Response\ApiHttpErrorResponse;
use ApiRol\Shared\UI\Response\ApiHttpResponse;
use ApiRol\Shared\UI\Response\HttpResponseCode;
use Symfony\Component\HttpFoundation\Request;

final class GetCharacterController extends ApiController
{
    public function __construct(
        CommandBusInterface $commandBus,
        QueryBusInterface $queryBus,
        private CharacterResponseTransformer $transformer
    ) {
        parent::__construct($commandBus, $queryBus);
    }

    public function __invoke(Request $request, string $characterId): ApiHttpResponse
    {
        try {
            /** @var FindCharacterQueryResponse $queryResponse */
            $queryResponse = $this->queryBus->ask(FindCharacterQuery::create(
                $characterId,
            ));
        } catch (CharacterNotFoundException $e) {
            return ApiHttpErrorResponse::uniqueError($e->getMessage(), HttpResponseCode::HTTP_NOT_FOUND);
        }

        return new ApiHttpResponse($this->transformer->transform($queryResponse));
    }
}
