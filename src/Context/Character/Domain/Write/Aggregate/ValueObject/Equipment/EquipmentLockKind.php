<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Equipment;

enum EquipmentLockKind: int
{
    case ONE_HAND = 1;
    case TWO_HAND = 2;
    case HEAD = 3;
    case CHESS = 4;
    case GREAVES = 5;
    case BOOTS = 6;
}
