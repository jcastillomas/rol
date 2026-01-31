<?php

namespace ApiRol\Tests\Integration\Context\Character\Infrastructure\Write\Persistence\Doctrine\MySQL\Repository;

use ApiRol\Context\Character\Domain\Write\Aggregate\CharacterBase;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Character\CharacterId;
use ApiRol\Context\Character\Domain\Write\Exception\CharacterNotFoundException;
use ApiRol\Context\Character\Domain\Write\Repository\CharacterRepository;
use ApiRol\Shared\Infrastructure\Persistence\Doctrine\MySQL\Repository\AggregateRepository;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\CharacterStub;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject\CharacterIdStub;
use ApiRol\Tests\Infrastructure\Integration\MySQL\AggregateRepositoryTestCase;

class DoctrineCharacterRepositoryTest extends AggregateRepositoryTestCase
{
    public function test_it_saves_and_finds_a_character(): void
    {
        $expectedCharacter = $this->givenACharacterWith();
        $this->whenACharacterIsSaved($expectedCharacter);
        $this->thenACharacterIsFound($expectedCharacter);
    }

    public function test_it_throws_exception_when_character_is_not_found(): void
    {
        $nonExistingCharacterId = $this->givenANonExistingCharacterId();
        $this->expectException(CharacterNotFoundException::class);
        $this->whenFindingACharacter($nonExistingCharacterId);
    }

    private function givenASavedCharacter(?\DateTimeImmutable $updatedAt = null, ?\DateTimeImmutable $createdAt = null): CharacterBase
    {
        $character = CharacterStub::create(
            createdAt: $createdAt,
            updatedAt: $updatedAt
        );

        $this->repository->save($character);

        return $character;
    }

    private function givenACharacterWith(): CharacterBase {
        return CharacterStub::create(
            CharacterIdStub::random(),
        );
    }

    private function givenANonExistingCharacterId(): CharacterId
    {
        return CharacterIdStub::random();
    }

    private function whenACharacterIsSaved(CharacterBase $character): void
    {
        $this->repository->save($character);
        $this->em()->flush();
        $this->em()->clear();
    }

    private function whenFindingACharacter(CharacterId $characterId): CharacterBase
    {
        return $this->repository->find($characterId);
    }

    private function thenACharacterIsFound(
        CharacterBase $expectedCharacter,
    ): void {
        /** @var CharacterBase $actualCharacter */
        $actualCharacter = $this->repository->find($expectedCharacter->id());
        $this->assertEquals($expectedCharacter->id(), $actualCharacter->id());
        $this->assertEquals($expectedCharacter->createdAt()->getTimestamp(), $actualCharacter->createdAt()->getTimestamp());
        $this->assertEquals($expectedCharacter->updatedAt()->getTimestamp(), $actualCharacter->updatedAt()->getTimestamp());
        $this->assertTrue($expectedCharacter->characterName()->equalsTo($actualCharacter->characterName()));
        $this->assertTrue($expectedCharacter->characterDescription()->equalsTo($actualCharacter->characterDescription()));
        $this->assertTrue($expectedCharacter->characterLife()->equalsTo($actualCharacter->characterLife()));
        $this->assertTrue($expectedCharacter->characterArmour()->equalsTo($actualCharacter->characterArmour()));
        $this->assertTrue($expectedCharacter->characterAttArcanum()->equalsTo($actualCharacter->characterAttArcanum()));
        $this->assertTrue($expectedCharacter->characterAttCharisma()->equalsTo($actualCharacter->characterAttCharisma()));
        $this->assertTrue($expectedCharacter->characterAttConstitution()->equalsTo($actualCharacter->characterAttConstitution()));
        $this->assertTrue($expectedCharacter->characterAttDexterity()->equalsTo($actualCharacter->characterAttDexterity()));
        $this->assertTrue($expectedCharacter->characterAttStrength()->equalsTo($actualCharacter->characterAttStrength()));
    }

    protected function repository(): AggregateRepository
    {
        return self::getContainer()->get('test.' . CharacterRepository::class);
    }

    protected function purge(): void
    {
        $this->purgeTables('character_base');
    }
}
