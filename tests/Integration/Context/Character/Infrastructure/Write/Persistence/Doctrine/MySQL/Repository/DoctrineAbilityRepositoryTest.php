<?php

namespace ApiRol\Tests\Integration\Context\Character\Infrastructure\Write\Persistence\Doctrine\MySQL\Repository;

use ApiRol\Context\Character\Domain\Write\Aggregate\Ability;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability\AbilityId;
use ApiRol\Context\Character\Domain\Write\Exception\AbilityNotFoundException;
use ApiRol\Context\Character\Domain\Write\Repository\AbilityRepository;
use ApiRol\Shared\Infrastructure\Persistence\Doctrine\MySQL\Repository\AggregateRepository;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\AbilityStub;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject\AbilityIdStub;
use ApiRol\Tests\Infrastructure\Integration\MySQL\AggregateRepositoryTestCase;

class DoctrineAbilityRepositoryTest extends AggregateRepositoryTestCase
{
    public function test_it_saves_and_finds_a_ability(): void
    {
        $expectedAbility = $this->givenAbilityWith();
        $this->whenAbilityIsSaved($expectedAbility);
        $this->thenAbilityIsFound($expectedAbility);
    }

    public function test_it_throws_exception_when_ability_is_not_found(): void
    {
        $nonExistingAbilityId = $this->givenANonExistingAbilityId();
        $this->expectException(AbilityNotFoundException::class);
        $this->whenFindingAbility($nonExistingAbilityId);
    }

    private function givenASavedAbility(?\DateTimeImmutable $updatedAt = null, ?\DateTimeImmutable $createdAt = null): Ability
    {
        $ability = AbilityStub::create(
            createdAt: $createdAt,
            updatedAt: $updatedAt
        );

        $this->repository->save($ability);

        return $ability;
    }

    private function givenAbilityWith(): Ability {
        return AbilityStub::create(
            AbilityIdStub::random(),
        );
    }

    private function givenANonExistingAbilityId(): AbilityId
    {
        return AbilityIdStub::random();
    }

    private function whenAbilityIsSaved(Ability $ability): void
    {
        $this->repository->save($ability);
        $this->em()->flush();
        $this->em()->clear();
    }

    private function whenFindingAbility(AbilityId $abilityId): Ability
    {
        return $this->repository->find($abilityId);
    }

    private function thenAbilityIsFound(
        Ability $expectedAbility,
    ): void {
        /** @var Ability $actualAbility */
        $actualAbility = $this->repository->find($expectedAbility->id());
        $this->assertEquals($expectedAbility->id(), $actualAbility->id());
        $this->assertEquals($expectedAbility->createdAt()->getTimestamp(), $actualAbility->createdAt()->getTimestamp());
        $this->assertEquals($expectedAbility->updatedAt()->getTimestamp(), $actualAbility->updatedAt()->getTimestamp());
        $this->assertTrue($expectedAbility->abilityName()->equalsTo($actualAbility->abilityName()));
        $this->assertTrue($expectedAbility->abilityDescription()->equalsTo($actualAbility->abilityDescription()));
        $this->assertTrue($expectedAbility->abilityLength()->equalsTo($actualAbility->abilityLength()));
        $this->assertEquals($expectedAbility->abilityTargetKind()->value, $actualAbility->abilityTargetKind()->value);
        $this->assertEquals($expectedAbility->abilityValueKind()->value, $actualAbility->abilityValueKind()->value);
        $this->assertTrue($expectedAbility->abilityValue()->equalsTo($actualAbility->abilityValue()));
    }

    protected function repository(): AggregateRepository
    {
        return self::getContainer()->get('test.' . AbilityRepository::class);
    }

    protected function purge(): void
    {
        $this->purgeTables('ability');
    }
}
