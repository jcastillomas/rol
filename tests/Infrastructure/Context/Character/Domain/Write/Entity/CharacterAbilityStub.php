<?php

declare(strict_types=1);

namespace ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Entity;

use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability\AbilityId;
use ApiRol\Context\Character\Domain\Write\Entity\CharacterAbility;
use ApiRol\Context\Character\Domain\Write\Entity\ValueObject\CharacterAbilityId;
use ApiRol\Shared\Domain\Service\ReflectionManager;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject\AbilityIdStub;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Entity\ValueObject\CharacterAbilityIdStub;
use ApiRol\Tests\Infrastructure\Shared\Domain\ValueObject\DateTimeImmutableStub;
use DateTimeImmutable;

final class CharacterAbilityStub
{
    public static function create(
        ?CharacterAbilityId $id = null,
        ?DateTimeImmutable  $createdAt = null,
        ?DateTimeImmutable  $updatedAt = null,
        ?AbilityId          $abilityId = null,
    ): CharacterAbility
    {
        $rm = ReflectionManager::create();

        return $rm->buildObject(
            CharacterAbility::class,
            [
                'id' => $id ?? CharacterAbilityIdStub::random(),
                'createdAt' => $createdAt ?? DateTimeImmutableStub::yesterday(),
                'updatedAt' => $updatedAt ?? DateTimeImmutableStub::now(),
                'abilityId' => $abilityId ?? AbilityIdStub::random(),
            ]
        );
    }

    public static function createWithValidNullValues(
        ?CharacterAbilityId $id = null,
        ?DateTimeImmutable  $createdAt = null,
        ?DateTimeImmutable  $updatedAt = null,
        ?AbilityId          $abilityId = null,
    ): CharacterAbility
    {
        $rm = ReflectionManager::create();

        return $rm->buildObject(
            CharacterAbility::class,
            [
                'id' => $id ?? CharacterAbilityIdStub::random(),
                'createdAt' => $createdAt ?? DateTimeImmutableStub::yesterday(),
                'updatedAt' => $updatedAt,
                'abilityId' => $abilityId ?? AbilityIdStub::random(),
            ]
        );
    }

    public static function random(): CharacterAbility
    {
        return self::create();
    }
}
