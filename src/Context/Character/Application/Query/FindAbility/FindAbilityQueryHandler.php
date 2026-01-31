<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\Application\Query\FindAbility;

use ApiRol\Context\Character\Domain\Write\Repository\AbilityRepository;
use ApiRol\Shared\Application\Bus\Query\QueryHandlerInterface;

final class FindAbilityQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private AbilityRepository $repository,
        private FindAbilityQueryResponseConverter $responseConverter
    ) {
    }

    public function __invoke(FindAbilityQuery $query): FindAbilityQueryResponse
    {
        $ability = $this->repository->find($query->abilityId());

        return $this->responseConverter->__invoke($ability);
    }
}
