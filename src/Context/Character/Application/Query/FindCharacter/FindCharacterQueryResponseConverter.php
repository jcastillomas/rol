<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\Application\Query\FindCharacter;

use ApiRol\Context\Character\Domain\Write\Aggregate\CharacterBase;

final class FindCharacterQueryResponseConverter
{
    public function __invoke(CharacterBase $doctor): FindCharacterQueryResponse
    {
        return new FindCharacterQueryResponse([
            FindCharacterQueryResponse::ID => $doctor->id()->value(),
        ]);
    }
}
