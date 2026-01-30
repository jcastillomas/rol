<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\Application\Query\FindCharacter;

use ApiRol\Context\Character\Domain\Write\Repository\CharacterRepository;
use ApiRol\Shared\Application\Bus\Query\QueryHandlerInterface;

final class FindCharacterQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private CharacterRepository $repository,
        private FindCharacterQueryResponseConverter $responseConverter
    ) {
    }

    public function __invoke(FindCharacterQuery $query): FindCharacterQueryResponse
    {
        $character = $this->repository->find($query->characterId());

        return $this->responseConverter->__invoke($character);
    }
}
