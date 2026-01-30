<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\Domain\Write\Aggregate;

use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Equipment\EquipmentId;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Equipment\EquipmentKind;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Equipment\EquipmentLockKind;
use ApiRol\Shared\Domain\ValueObject\Description;
use ApiRol\Shared\Domain\ValueObject\Name;
use ApiRol\Shared\Domain\Write\Aggregate\AggregateRoot;

class Equipment extends AggregateRoot
{
    private Name $name;
    private Description $description;
    private EquipmentKind $kind;
    private EquipmentLockKind $lockKind;


    public static function create(
        EquipmentId          $id,
        Name        $name,
        Description $description,
        EquipmentKind        $kind,
        EquipmentLockKind    $lockKind
    ): self
    {
        $instance = new self($id);
        $instance->name = $name;
        $instance->description = $description;
        $instance->kind = $kind;
        $instance->lockKind = $lockKind;

        return $instance;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getDescription(): Description
    {
        return $this->description;
    }

    public function getKind(): EquipmentKind
    {
        return $this->kind;
    }

    public function getLockKind(): EquipmentLockKind
    {
        return $this->lockKind;
    }
}
