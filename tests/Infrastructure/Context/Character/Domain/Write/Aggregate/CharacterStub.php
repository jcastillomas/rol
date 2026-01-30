<?php

declare(strict_types=1);

namespace ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate;

use ApiRol\Context\Character\Domain\Write\Aggregate\CharacterBase;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Character\CharacterArmour;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Character\CharacterAttribute;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Character\CharacterId;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Character\CharacterLife;
use ApiRol\Context\Character\Domain\Write\Entity\CharacterAbilities;
use ApiRol\Shared\Domain\Service\ReflectionManager;
use ApiRol\Shared\Domain\ValueObject\Description;
use ApiRol\Shared\Domain\ValueObject\Name;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject\CharacterArmourStub;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject\CharacterAttributeStub;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject\CharacterIdStub;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject\CharacterLifeStub;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Entity\CharacterAbilityStub;
use ApiRol\Tests\Infrastructure\Shared\Domain\ValueObject\DateTimeImmutableStub;
use ApiRol\Tests\Infrastructure\Shared\Domain\ValueObject\DescriptionStub;
use ApiRol\Tests\Infrastructure\Shared\Domain\ValueObject\NameStub;
use DateTimeImmutable;

final class CharacterStub
{
    public static function create(
        ?CharacterId        $id = null,
        ?DateTimeImmutable  $createdAt = null,
        ?DateTimeImmutable  $updatedAt = null,
        ?Name               $characterName = null,
        ?Description        $characterDescription = null,
        ?CharacterLife      $characterLife = null,
        ?CharacterArmour    $characterArmour = null,
        ?CharacterAttribute $characterAttArcanum = null,
        ?CharacterAttribute $characterAttCharisma = null,
        ?CharacterAttribute $characterAttConstitution = null,
        ?CharacterAttribute $characterAttDexterity = null,
        ?CharacterAttribute $characterAttStrength = null,
        ?CharacterAbilities $characterAbilities = null,
    ): CharacterBase
    {
        $rm = ReflectionManager::create();

        return $rm->buildObject(
            CharacterBase::class,
            [
                'id' => $id ?? CharacterIdStub::random(),
                'createdAt' => $createdAt ?? DateTimeImmutableStub::yesterday(),
                'updatedAt' => $updatedAt ?? DateTimeImmutableStub::now(),
                'characterName' => $characterName ?? NameStub::random(),
                'characterDescription' => $characterDescription ?? DescriptionStub::random(),
                'characterLife' => $characterLife ?? CharacterLifeStub::random(),
                'characterArmour' => $characterArmour ?? CharacterArmourStub::random(),
                'characterAttArcanum' => $characterAttArcanum ?? CharacterAttributeStub::random(),
                'characterAttCharisma' => $characterAttCharisma ?? CharacterAttributeStub::random(),
                'characterAttConstitution' => $characterAttConstitution ?? CharacterAttributeStub::random(),
                'characterAttDexterity' => $characterAttDexterity ?? CharacterAttributeStub::random(),
                'characterAttStrength' => $characterAttStrength ?? CharacterAttributeStub::random(),
                'characterAbilities' => $characterAbilities ?? CharacterAbilities::create([CharacterAbilityStub::random()]),
            ]
        );
    }

    public static function createWithValidNullValues(
        ?CharacterId        $id = null,
        ?DateTimeImmutable  $createdAt = null,
        ?DateTimeImmutable  $updatedAt = null,
        ?Name               $characterName = null,
        ?Description        $characterDescription = null,
        ?CharacterLife      $characterLife = null,
        ?CharacterArmour    $characterArmour = null,
        ?CharacterAttribute $characterAttArcanum = null,
        ?CharacterAttribute $characterAttCharisma = null,
        ?CharacterAttribute $characterAttConstitution = null,
        ?CharacterAttribute $characterAttDexterity = null,
        ?CharacterAttribute $characterAttStrength = null,
        ?CharacterAbilities $characterAbilities = null,
    ): CharacterBase
    {
        $rm = ReflectionManager::create();

        return $rm->buildObject(
            CharacterBase::class,
            [
                'id' => $id ?? CharacterIdStub::random(),
                'createdAt' => $createdAt ?? DateTimeImmutableStub::yesterday(),
                'updatedAt' => $updatedAt,
                'characterName' => $characterName ?? NameStub::random(),
                'characterDescription' => $characterDescription ?? DescriptionStub::random(),
                'characterLife' => $characterLife ?? CharacterLifeStub::random(),
                'characterArmour' => $characterArmour ?? CharacterArmourStub::random(),
                'characterAttArcanum' => $characterAttArcanum ?? CharacterAttributeStub::random(),
                'characterAttCharisma' => $characterAttCharisma ?? CharacterAttributeStub::random(),
                'characterAttConstitution' => $characterAttConstitution ?? CharacterAttributeStub::random(),
                'characterAttDexterity' => $characterAttDexterity ?? CharacterAttributeStub::random(),
                'characterAttStrength' => $characterAttStrength ?? CharacterAttributeStub::random(),
                'characterAbilities' => $characterAbilities ?? CharacterAbilities::create([CharacterAbilityStub::random()]),
            ]
        );
    }

    public static function random(): CharacterBase
    {
        return self::create();
    }
}
