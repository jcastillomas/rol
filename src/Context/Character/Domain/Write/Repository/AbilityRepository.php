<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\Domain\Write\Repository;

use ApiRol\Context\Character\Domain\Write\Aggregate\Ability;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability\AbilityId;

interface AbilityRepository
{
    public function save(Ability $ability): void;
    public function find(AbilityId $id): Ability;
}
