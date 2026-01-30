<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability;

enum AbilityValueKind: int
{
    case DAMAGE = 1;
    case HEAL = 2;
    case OTHER = 3;
}
