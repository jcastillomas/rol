<?php

namespace ApiRol\Tests\Unit\Context\Character\Application\Query\FindAbility;

use ApiRol\Context\Character\Application\Query\FindAbility\FindAbilityQuery;
use ApiRol\Context\Character\Application\Query\FindAbility\FindAbilityQueryHandler;
use ApiRol\Context\Character\Application\Query\FindAbility\FindAbilityQueryResponse;
use ApiRol\Context\Character\Application\Query\FindAbility\FindAbilityQueryResponseConverter;
use ApiRol\Context\Character\Domain\Write\Aggregate\Ability;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability\AbilityId;
use ApiRol\Context\Character\Domain\Write\Exception\AbilityNotFoundException;
use ApiRol\Context\Character\Domain\Write\Repository\AbilityRepository;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\AbilityStub;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject\AbilityIdStub;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Repository\AbilityRepositoryMock;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophet;

class FindAbilityQueryHandlerTest extends TestCase
{
    private AbilityRepositoryMock $abilityRepository;
    private FindAbilityQueryHandler $handler;

    protected function setUp(): void
    {
        $prophet = new Prophet();
        $this->abilityRepository = new AbilityRepositoryMock($prophet->prophesize(AbilityRepository::class));
        $this->handler = new FindAbilityQueryHandler($this->abilityRepository->reveal(), new FindAbilityQueryResponseConverter());
    }

    public function test_it_should_retrieve_ability(): void
    {
        $abilityId = $this->givenAAbilityId();
        $ability = $this->givenAAbilityWithId($abilityId);
        $query = $this->givenAQuery($abilityId);
        $this->thenAbilityShouldBeFound($abilityId, $ability);
        $queryResponse = $this->whenHandlingQuery($query);

        $this->assertIsArray($queryResponse->result());

        $this->assertEquals($abilityId->value(), $queryResponse->id());
        $this->assertEquals($ability->id()->value(), $queryResponse->id());
    }

    public function test_it_throws_exception_when_ability_is_not_found(): void
    {
        $abilityId = $this->givenAAbilityId();
        $query = $this->givenAQuery($abilityId);
        $this->thenAbilityShouldNotBeFound($abilityId);
        $this->whenHandlingQuery($query);
    }

    private function givenAAbilityId(): AbilityId
    {
        return AbilityIdStub::random();
    }

    private function givenAAbilityWithId(AbilityId $abilityId): Ability
    {
        return AbilityStub::create($abilityId);
    }

    private function givenAQuery(AbilityId $abilityId): FindAbilityQuery
    {
        return FindAbilityQuery::create($abilityId->value());
    }

    private function whenHandlingQuery(FindAbilityQuery $query): FindAbilityQueryResponse
    {
        return $this->handler->__invoke($query);
    }

    private function thenAbilityShouldBeFound(AbilityId $abilityId, Ability $ability): void
    {
        $this->abilityRepository->shouldFind($abilityId, $ability);
    }

    private function thenAbilityShouldNotBeFound(AbilityId $abilityId): void
    {
        $this->abilityRepository->shouldNotFind($abilityId);
        $this->expectException(AbilityNotFoundException::class);
    }
}
