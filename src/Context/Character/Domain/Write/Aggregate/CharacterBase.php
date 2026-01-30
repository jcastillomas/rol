<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\Domain\Write\Aggregate;

use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Character\CharacterArmour;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Character\CharacterAttribute;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Character\CharacterId;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Character\CharacterLife;
use ApiRol\Context\Character\Domain\Write\Entity\CharacterAbilities;
use ApiRol\Shared\Domain\ValueObject\Description;
use ApiRol\Shared\Domain\ValueObject\Name;
use ApiRol\Shared\Domain\Write\Aggregate\AggregateRoot;
use DateTimeImmutable;

class CharacterBase extends AggregateRoot
{
    private \DateTimeImmutable $createdAt;
    private ?\DateTimeImmutable $updatedAt;
    private CharacterArmour $characterArmour;
    private CharacterAttribute $characterAttArcanum;
    private CharacterAttribute $characterAttCharisma;
    private CharacterAttribute $characterAttConstitution;
    private CharacterAttribute $characterAttDexterity;
    private CharacterAttribute $characterAttStrength;
    private Description $characterDescription;
    private CharacterLife $characterLife;
    private Name $characterName;
    /** @var CharacterAbilities $characterAbilities */
    private mixed $characterAbilities;

    public static function create(
        CharacterId        $characterId,
        Name               $characterName,
        Description        $characterDescription,
        CharacterLife      $characterLife,
        CharacterArmour    $characterArmour,
        CharacterAttribute $characterAttArcanum,
        CharacterAttribute $characterAttCharisma,
        CharacterAttribute $characterAttConstitution,
        CharacterAttribute $characterAttDexterity,
        CharacterAttribute $characterAttStrength,
        CharacterAbilities $characterAbilities,
    ): self
    {
        $character = new self($characterId);
        $character->createdAt = new DateTimeImmutable();
        $character->updatedAt = null;
        $character->characterName = $characterName;
        $character->characterDescription = $characterDescription;
        $character->characterLife = $characterLife;
        $character->characterArmour = $characterArmour;
        $character->characterAttArcanum = $characterAttArcanum;
        $character->characterAttCharisma = $characterAttCharisma;
        $character->characterAttConstitution = $characterAttConstitution;
        $character->characterAttDexterity = $characterAttDexterity;
        $character->characterAttStrength = $characterAttStrength;
        $character->characterAbilities = $characterAbilities;

        return $character;
    }

    public function characterArmour(): CharacterArmour
    {
        return $this->characterArmour;
    }

    public function characterAttArcanum(): CharacterAttribute
    {
        return $this->characterAttArcanum;
    }

    public function characterAttCharisma(): CharacterAttribute
    {
        return $this->characterAttCharisma;
    }

    public function characterAttConstitution(): CharacterAttribute
    {
        return $this->characterAttConstitution;
    }

    public function characterAttDexterity(): CharacterAttribute
    {
        return $this->characterAttDexterity;
    }

    public function characterAttStrength(): CharacterAttribute
    {
        return $this->characterAttStrength;
    }

    public function characterDescription(): Description
    {
        return $this->characterDescription;
    }

    public function characterLife(): CharacterLife
    {
        return $this->characterLife;
    }

    public function characterName(): Name
    {
        return $this->characterName;
    }

    public function characterAbilities(): mixed
    {
        return CharacterAbilities::create($this->characterAbilities->toArray());
    }

    public function createdAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function updatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }
}
