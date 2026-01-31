<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\Domain\Write\Aggregate;

use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability\AbilityId;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability\AbilityLength;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability\AbilityTargetKind;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability\AbilityValue;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability\AbilityValueKind;
use ApiRol\Shared\Domain\ValueObject\Description;
use ApiRol\Shared\Domain\ValueObject\Name;
use ApiRol\Shared\Domain\Write\Aggregate\AggregateRoot;
use DateTimeImmutable;

class Ability extends AggregateRoot
{
    private DateTimeImmutable $createdAt;
    private ?DateTimeImmutable $updatedAt;
    private AbilityLength $abilityLength;
    private AbilityTargetKind $abilityTargetKind;
    private Name $abilityName;
    private AbilityValueKind $abilityValueKind;
    private AbilityValue $abilityValue;
    private Description $abilityDescription;

    public static function create(
        AbilityId         $id,
        Name              $abilityName,
        Description       $abilityDescription,
        AbilityLength     $abilityLength,
        AbilityTargetKind $abilityTargetKind,
        AbilityValueKind  $abilityValueKind,
        AbilityValue      $abilityValue
    ): self
    {
        $ability = new self($id);
        $ability->createdAt = new DateTimeImmutable();
        $ability->updatedAt = null;
        $ability->abilityLength = $abilityLength;
        $ability->abilityTargetKind = $abilityTargetKind;
        $ability->abilityName = $abilityName;
        $ability->abilityValueKind = $abilityValueKind;
        $ability->abilityValue = $abilityValue;
        $ability->abilityDescription = $abilityDescription;

        return $ability;
    }

    public function abilityLength(): AbilityLength
    {
        return $this->abilityLength;
    }

    public function abilityTargetKind(): AbilityTargetKind
    {
        return $this->abilityTargetKind;
    }

    public function abilityName(): Name
    {
        return $this->abilityName;
    }

    public function abilityValueKind(): AbilityValueKind
    {
        return $this->abilityValueKind;
    }

    public function abilityValue(): AbilityValue
    {
        return $this->abilityValue;
    }

    public function abilityDescription(): Description
    {
        return $this->abilityDescription;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function updatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }
}
