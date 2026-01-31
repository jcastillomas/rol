<?php

declare(strict_types=1);

namespace ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate;

use ApiRol\Context\Character\Domain\Write\Aggregate\Ability;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability\AbilityLength;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability\AbilityTargetKind;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability\AbilityValue;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability\AbilityValueKind;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Character\CharacterArmour;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Character\CharacterAttribute;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability\AbilityId;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Character\CharacterLife;
use ApiRol\Context\Character\Domain\Write\Entity\CharacterAbilities;
use ApiRol\Shared\Domain\Service\ReflectionManager;
use ApiRol\Shared\Domain\ValueObject\Description;
use ApiRol\Shared\Domain\ValueObject\Name;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject\AbilityLengthStub;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject\AbilityTargetKindStub;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject\AbilityValueKindStub;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject\AbilityValueStub;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject\AbilityIdStub;
use ApiRol\Tests\Infrastructure\Shared\Domain\ValueObject\DateTimeImmutableStub;
use ApiRol\Tests\Infrastructure\Shared\Domain\ValueObject\DescriptionStub;
use ApiRol\Tests\Infrastructure\Shared\Domain\ValueObject\NameStub;
use DateTimeImmutable;

final class AbilityStub
{
    public static function create(
        ?AbilityId       $id = null,
        ?DateTimeImmutable $createdAt = null,
        ?DateTimeImmutable $updatedAt = null,
        ?Name               $abilityName = null,
        ?Description        $abilityDescription = null,
        ?AbilityLength      $abilityLength = null,
        ?AbilityTargetKind  $abilityTargetKind = null,
        ?AbilityValueKind   $abilityValueKind = null,
        ?AbilityValue       $abilityValue = null,

    ): Ability
    {
        $rm = ReflectionManager::create();

        return $rm->buildObject(
            Ability::class,
            [
                'id' => $id ?? AbilityIdStub::random(),
                'createdAt' => $createdAt ?? DateTimeImmutableStub::yesterday(),
                'updatedAt' => $updatedAt ?? DateTimeImmutableStub::now(),
                'abilityName' => $abilityName ?? NameStub::random(),
                'abilityDescription' => $abilityDescription ?? DescriptionStub::random(),
                'abilityLength' => $abilityLength ?? AbilityLengthStub::random(),
                'abilityTargetKind' => $abilityTargetKind ?? AbilityTargetKindStub::random(),
                'abilityValueKind' => $abilityValueKind ?? AbilityValueKindStub::random(),
                'abilityValue' => $abilityValue ?? AbilityValueStub::random(),
            ]
        );
    }

    public static function createWithValidNullValues(
        ?AbilityId        $id = null,
        ?DateTimeImmutable  $createdAt = null,
        ?DateTimeImmutable  $updatedAt = null,
        ?Name               $abilityName = null,
        ?Description        $abilityDescription = null,
        ?AbilityLength      $abilityLength = null,
        ?AbilityTargetKind  $abilityTargetKind = null,
        ?AbilityValueKind   $abilityValueKind = null,
        ?AbilityValue       $abilityValue = null,
    ): Ability
    {
        $rm = ReflectionManager::create();

        return $rm->buildObject(
            Ability::class,
            [
                'id' => $id ?? AbilityIdStub::random(),
                'createdAt' => $createdAt ?? DateTimeImmutableStub::yesterday(),
                'updatedAt' => $updatedAt,
                'abilityName' => $abilityName ?? NameStub::random(),
                'abilityDescription' => $abilityDescription ?? DescriptionStub::random(),
                'abilityLength' => $abilityLength ?? AbilityLengthStub::random(),
                'abilityTargetKind' => $abilityTargetKind ?? AbilityTargetKindStub::random(),
                'abilityValueKind' => $abilityValueKind ?? AbilityValueKindStub::random(),
                'abilityValue' => $abilityValue ?? AbilityValueStub::random(),
            ]
        );
    }

    public static function random(): Ability
    {
        return self::create();
    }
}
