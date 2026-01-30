<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\Domain\Write\Repository;

use ApiRol\Context\Character\Domain\Write\Aggregate\CharacterBase;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Character\CharacterId;

interface CharacterRepository
{
    public function save(CharacterBase $character): void;
    public function find(CharacterId $id): CharacterBase;
}
