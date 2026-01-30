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
        AbilityId          $id,
        AbilityLength      $abilityLength,
        AbilityTargetKind  $abilityTargetKind,
        Name        $abilityName,
        AbilityValueKind   $abilityValueKind,
        AbilityValue       $abilityValue,
        Description $abilityDescription
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

    public function setAbilityLength(AbilityLength $abilityLength): void
    {
        $this->abilityLength = $abilityLength;
    }

    public function setAbilityTargetKind(AbilityTargetKind $abilityTargetKind): void
    {
        $this->abilityTargetKind = $abilityTargetKind;
    }

    public function setName(Name $abilityName): void
    {
        $this->abilityName = $abilityName;
    }

    public function setAbilityValueKind(AbilityValueKind $abilityValueKind): void
    {
        $this->abilityValueKind = $abilityValueKind;
    }

    public function setAbilityValue(AbilityValue $abilityValue): void
    {
        $this->abilityValue = $abilityValue;
    }

    public function setDescription(Description $abilityDescription): void
    {
        $this->abilityDescription = $abilityDescription;
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
