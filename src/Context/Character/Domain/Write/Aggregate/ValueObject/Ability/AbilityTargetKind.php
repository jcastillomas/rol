<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability;

enum AbilityTargetKind: int
{
    case SELF = 1;
    case ALLY = 2;
    case ENEMY = 3;
    case SHAPE = 4;
}
