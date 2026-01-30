<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\Application\Command\CreateCharacter;

use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability\AbilityId;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Character\CharacterArmour;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Character\CharacterAttribute;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Character\CharacterId;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Character\CharacterLife;
use ApiRol\Context\Character\Domain\Write\Entity\CharacterAbilities;
use ApiRol\Context\Character\Domain\Write\Entity\CharacterAbility;
use ApiRol\Context\Character\Domain\Write\Entity\ValueObject\CharacterAbilityId;
use ApiRol\Shared\Application\Bus\Command\Command;
use ApiRol\Shared\Domain\ValueObject\Description;
use ApiRol\Shared\Domain\ValueObject\Name;

final class CreateCharacterCommand extends Command
{
    private const ID = 'id';
    private const CHARACTER_NAME = 'characterName';
    private const CHARACTER_DESCRIPTION = 'characterDescription';
    private const CHARACTER_LIFE = 'characterLife';
    private const CHARACTER_ARMOUR = 'characterArmour';
    private const CHARACTER_ARCANUM = 'characterAttArcanum';
    private const CHARACTER_CHARISMA = 'characterAttCharisma';
    private const CHARACTER_CONSTITUTION = 'characterAttConstitution';
    private const CHARACTER_DEXTERITY = 'characterAttDexterity';
    private const CHARACTER_STRENGTH = 'characterAttStrength';
    private const CHARACTER_ABILITIES = 'characterAbilities';

    public static function create(
        string $id,
        string $characterName,
        string $characterDescription,
        int $characterLife,
        int $characterArmour,
        int $characterAttArcanum,
        int $characterAttCharisma,
        int $characterAttConstitution,
        int $characterAttDexterity,
        int $characterAttStrength,
        array $characterAbilities,
    ): CreateCharacterCommand {
        return new self([
            self::ID => $id,
            self::CHARACTER_NAME => $characterName,
            self::CHARACTER_DESCRIPTION => $characterDescription,
            self::CHARACTER_LIFE => $characterLife,
            self::CHARACTER_ARMOUR => $characterArmour,
            self::CHARACTER_ARCANUM => $characterAttArcanum,
            self::CHARACTER_CHARISMA => $characterAttCharisma,
            self::CHARACTER_CONSTITUTION => $characterAttConstitution,
            self::CHARACTER_DEXTERITY => $characterAttDexterity,
            self::CHARACTER_STRENGTH => $characterAttStrength,
            self::CHARACTER_ABILITIES => $characterAbilities,
        ]);
    }

    public function id(): CharacterId
    {
        return CharacterId::fromString($this->get(self::ID));
    }


    public function characterName(): Name
    {
        return Name::fromString($this->get(self::CHARACTER_NAME));
    }

    public function characterDescription(): Description
    {
        return Description::fromString($this->get(self::CHARACTER_DESCRIPTION));
    }

    public function characterLife(): CharacterLife
    {
        return CharacterLife::fromInt($this->get(self::CHARACTER_LIFE));
    }

    public function characterArmour(): CharacterArmour
    {
        return CharacterArmour::fromInt($this->get(self::CHARACTER_ARMOUR));
    }

    public function characterAttArcanum(): CharacterAttribute
    {
        return CharacterAttribute::fromInt($this->get(self::CHARACTER_ARCANUM));
    }

    public function characterAttCharisma(): CharacterAttribute
    {
        return CharacterAttribute::fromInt($this->get(self::CHARACTER_CHARISMA));
    }

    public function characterAttConstitution(): CharacterAttribute
    {
        return CharacterAttribute::fromInt($this->get(self::CHARACTER_CONSTITUTION));
    }

    public function characterAttDexterity(): CharacterAttribute
    {
        return CharacterAttribute::fromInt($this->get(self::CHARACTER_DEXTERITY));
    }

    public function characterAttStrength(): CharacterAttribute
    {
        return CharacterAttribute::fromInt($this->get(self::CHARACTER_STRENGTH));
    }

    public function characterAbilities(): CharacterAbilities
    {
        $characterAbilities = array_map(
            fn ($item) => $this->createCharacterAbility($item),
            $this->get(self::CHARACTER_ABILITIES)
        );

        return CharacterAbilities::create($characterAbilities);
    }

    protected function version(): string
    {
        return '1.0';
    }

    public static function messageName(): string
    {
        return 'command.character.create';
    }

    private function createCharacterAbility(array $characterAbility): CharacterAbility
    {
        return CharacterAbility::create(
            CharacterAbilityId::fromString($characterAbility['id']),
            AbilityId::fromString($characterAbility['abilityId']),
        );
    }
}
