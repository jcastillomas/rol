<?php

namespace ApiRol\Tests\Unit\Context\Character\Application\Query\FindCharacter;

use ApiRol\Context\Character\Application\Query\FindCharacter\FindCharacterQuery;
use ApiRol\Context\Character\Application\Query\FindCharacter\FindCharacterQueryHandler;
use ApiRol\Context\Character\Application\Query\FindCharacter\FindCharacterQueryResponse;
use ApiRol\Context\Character\Application\Query\FindCharacter\FindCharacterQueryResponseConverter;
use ApiRol\Context\Character\Domain\Exception\CharacterNotFoundException;
use ApiRol\Context\Character\Domain\Write\Aggregate\CharacterBase;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Character\CharacterId;
use ApiRol\Context\Character\Domain\Write\Repository\CharacterRepository;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\CharacterStub;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject\CharacterIdStub;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Repository\CharacterRepositoryMock;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophet;

class FindCharacterQueryHandlerTest extends TestCase
{
    private CharacterRepositoryMock $characterRepository;
    private FindCharacterQueryHandler $handler;

    protected function setUp(): void
    {
        $prophet = new Prophet();
        $this->characterRepository = new CharacterRepositoryMock($prophet->prophesize(CharacterRepository::class));
        $this->handler = new FindCharacterQueryHandler($this->characterRepository->reveal(), new FindCharacterQueryResponseConverter());
    }

    public function test_it_should_retrieve_character(): void
    {
        $characterId = $this->givenACharacterId();
        $character = $this->givenACharacterWithId($characterId);
        $query = $this->givenAQuery($characterId);
        $this->thenCharacterShouldBeFound($characterId, $character);
        $queryResponse = $this->whenHandlingQuery($query);

        $this->assertIsArray($queryResponse->result());

        $this->assertEquals($characterId->value(), $queryResponse->id());
        $this->assertEquals($character->id()->value(), $queryResponse->id());
    }

    public function test_it_throws_exception_when_character_is_not_found(): void
    {
        $characterId = $this->givenACharacterId();
        $query = $this->givenAQuery($characterId);
        $this->thenCharacterShouldNotBeFound($characterId);
        $this->whenHandlingQuery($query);
    }

    private function givenACharacterId(): CharacterId
    {
        return CharacterIdStub::random();
    }

    private function givenACharacterWithId(CharacterId $characterId): CharacterBase
    {
        return CharacterStub::create($characterId);
    }

    private function givenAQuery(CharacterId $characterId): FindCharacterQuery
    {
        return FindCharacterQuery::create($characterId->value());
    }

    private function whenHandlingQuery(FindCharacterQuery $query): FindCharacterQueryResponse
    {
        return $this->handler->__invoke($query);
    }

    private function thenCharacterShouldBeFound(CharacterId $characterId, CharacterBase $character): void
    {
        $this->characterRepository->shouldFind($characterId, $character);
    }

    private function thenCharacterShouldNotBeFound(CharacterId $characterId): void
    {
        $this->characterRepository->shouldNotFind($characterId);
        $this->expectException(CharacterNotFoundException::class);
    }
}
