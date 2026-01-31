<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\Application\Command\CreateAbility;

use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability\AbilityId;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability\AbilityLength;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability\AbilityTargetKind;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability\AbilityValue;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability\AbilityValueKind;
use ApiRol\Shared\Application\Bus\Command\Command;
use ApiRol\Shared\Domain\ValueObject\Description;
use ApiRol\Shared\Domain\ValueObject\Name;

final class CreateAbilityCommand extends Command
{
    private const ID = 'id';
    private const ABILITY_NAME = 'abilityName';
    private const ABILITY_DESCRIPTION = 'abilityDescription';
    const ABILITY_LENGTH = 'abilityLength';
    const ABILITY_TARGET_KIND = 'abilityTargetKind';
    const ABILITY_VALUE_KIND = 'abilityValueKind';
    const ABILITY_VALUE = 'abilityValue';

    public static function create(
        string $id,
        string $abilityName,
        string $abilityDescription,
        int    $abilityLength,
        int    $abilityTargetKind,
        int    $abilityValueKind,
        string $abilityValue
    ): CreateAbilityCommand
    {
        return new self([
            self::ID => $id,
            self::ABILITY_NAME => $abilityName,
            self::ABILITY_DESCRIPTION => $abilityDescription,
            self::ABILITY_LENGTH => $abilityLength,
            self::ABILITY_TARGET_KIND => $abilityTargetKind,
            self::ABILITY_VALUE_KIND => $abilityValueKind,
            self::ABILITY_VALUE => $abilityValue,
        ]);
    }

    public function id(): AbilityId
    {
        return AbilityId::fromString($this->get(self::ID));
    }

    public function abilityName(): Name
    {
        return Name::fromString($this->get(self::ABILITY_NAME));
    }

    public function abilityDescription(): Description
    {
        return Description::fromString($this->get(self::ABILITY_DESCRIPTION));
    }

    public function abilityLength(): AbilityLength
    {
        return AbilityLength::fromInt($this->get(self::ABILITY_LENGTH));
    }

    public function abilityTargetKind(): AbilityTargetKind
    {
        return AbilityTargetKind::from($this->get(self::ABILITY_TARGET_KIND));
    }

    public function abilityValueKind(): AbilityValueKind
    {
        return AbilityValueKind::from($this->get(self::ABILITY_VALUE_KIND));
    }

    public function abilityValue(): AbilityValue
    {
        return AbilityValue::fromString($this->get(self::ABILITY_VALUE));
    }

    protected function version(): string
    {
        return '1.0';
    }

    public static function messageName(): string
    {
        return 'command.character.create';
    }
}
