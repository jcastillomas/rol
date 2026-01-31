<?php

declare(strict_types=1);

namespace ApiRol\Tests\DataFixtures\DataLoaders;

use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability\AbilityId;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Character\CharacterArmour;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Character\CharacterAttribute;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Character\CharacterId;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Character\CharacterLife;
use ApiRol\Context\Character\Domain\Write\Entity\CharacterAbilities;
use ApiRol\Context\Character\Domain\Write\Entity\ValueObject\CharacterAbilityId;
use ApiRol\Shared\Domain\ValueObject\Description;
use ApiRol\Shared\Domain\ValueObject\Name;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\CharacterStub;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Entity\CharacterAbilitiesStub;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Entity\CharacterAbilityStub;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Yaml\Yaml;

class CharacterFixtures extends Fixtures
{
    public function load(ObjectManager $manager): void
    {
        foreach (Yaml::parseFile('tests/DataFixtures/character.yaml')['characters'] as $characterFixture) {
            $manager->persist(
                CharacterStub::create(
                    CharacterId::fromString($characterFixture['id']),
                    DateTimeImmutable::createFromFormat(DateTimeInterface::ATOM, $characterFixture['createdAt']),
                    array_key_exists('updatedAt', $characterFixture) ? DateTimeImmutable::createFromFormat(DateTimeInterface::ATOM, $characterFixture['updatedAt']) : null,
                    Name::fromString($characterFixture['characterName']),
                    Description::fromString($characterFixture['characterDescription']),
                    CharacterLife::fromInt($characterFixture['characterLife']),
                    CharacterArmour::fromInt($characterFixture['characterArmour']),
                    CharacterAttribute::fromInt($characterFixture['characterAttArcanum']),
                    CharacterAttribute::fromInt($characterFixture['characterAttCharisma']),
                    CharacterAttribute::fromInt($characterFixture['characterAttConstitution']),
                    CharacterAttribute::fromInt($characterFixture['characterAttDexterity']),
                    CharacterAttribute::fromInt($characterFixture['characterAttStrength']),
                    CharacterAbilitiesStub::create(
                        ...array_map(
                            fn (array $characterAbility) => CharacterAbilityStub::createWithValidNullValues(
                                id: CharacterAbilityId::fromString($characterAbility['characterAbilityId']),
                                abilityId: AbilityId::fromString($characterAbility['abilityId']),
                            ),
                            $characterFixture['characterAbilities']
                        ),
                    ),
                )
            );

        }

        $manager->flush();
    }
}
