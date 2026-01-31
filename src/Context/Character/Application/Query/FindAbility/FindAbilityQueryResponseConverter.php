<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\Application\Query\FindAbility;

use ApiRol\Context\Character\Domain\Write\Aggregate\Ability;

final class FindAbilityQueryResponseConverter
{
    public function __invoke(Ability $ability): FindAbilityQueryResponse
    {
        return new FindAbilityQueryResponse([
            FindAbilityQueryResponse::ID => $ability->id()->value(),
        ]);
    }
}
