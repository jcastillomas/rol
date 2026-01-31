<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability;

enum AbilityValueKind: int
{
    case OTHER = 0;
    case DAMAGE = 1;
    case HEAL = 2;
}
