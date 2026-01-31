<?php

declare(strict_types=1);

namespace ApiRol\Tests\DataFixtures\DataLoaders;

use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability\AbilityId;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability\AbilityLength;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability\AbilityTargetKind;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability\AbilityValue;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability\AbilityValueKind;
use ApiRol\Shared\Domain\ValueObject\Description;
use ApiRol\Shared\Domain\ValueObject\Name;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\AbilityStub;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Yaml\Yaml;

class AbilityFixtures extends Fixtures
{
    public function load(ObjectManager $manager): void
    {
        foreach (Yaml::parseFile('tests/DataFixtures/ability.yaml')['abilities'] as $abilityFixture) {
            $manager->persist(
                AbilityStub::create(
                    AbilityId::fromString($abilityFixture['id']),
                    DateTimeImmutable::createFromFormat(DateTimeInterface::ATOM, $abilityFixture['createdAt']),
                    array_key_exists('updatedAt', $abilityFixture) ? DateTimeImmutable::createFromFormat(DateTimeInterface::ATOM, $abilityFixture['updatedAt']) : null,
                    Name::fromString($abilityFixture['abilityName']),
                    Description::fromString($abilityFixture['abilityDescription']),
                    AbilityLength::fromInt($abilityFixture['abilityLength']),
                    AbilityTargetKind::tryFrom($abilityFixture['abilityTargetKind']),
                    AbilityValueKind::tryFrom($abilityFixture['abilityValueKind']),
                    AbilityValue::fromString($abilityFixture['abilityValue']),
                )
            );

        }

        $manager->flush();
    }
}
