<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Equipment;

enum EquipmentKind: int
{
    case ARMOUR = 1;
    case WEAPON = 2;
    case ACCESSORY = 3;
}
