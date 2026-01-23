<?php

declare(strict_types=1);

namespace ApiRol\Tests\DataFixtures\DataLoaders;

use ApiRol\Context\Rule\Domain\Write\Aggregate\ValueObject\RuleId;
use ApiRol\Tests\Infrastructure\Context\Rule\Domain\Write\Aggregate\RuleStub;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Yaml\Yaml;

class RuleFixtures extends Fixtures
{
    public function load(ObjectManager $manager): void
    {
        foreach (Yaml::parseFile('tests/DataFixtures/rule.yaml')['rules'] as $ruleFixture) {
            $manager->persist(
                RuleStub::create(
                    RuleId::fromString($ruleFixture['id']),
                    DateTimeImmutable::createFromFormat(DateTimeInterface::ATOM, $ruleFixture['createdAt']),
                    array_key_exists('updatedAt', $ruleFixture) ? DateTimeImmutable::createFromFormat(DateTimeInterface::ATOM, $ruleFixture['updatedAt']) : null,
                )
            );

        }

        $manager->flush();
    }
}
