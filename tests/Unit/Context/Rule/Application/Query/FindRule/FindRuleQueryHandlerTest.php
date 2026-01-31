<?php

namespace ApiRol\Tests\Unit\Context\Rule\Application\Query\FindRule;

use ApiRol\Context\Rule\Application\Query\FindRule\FindRuleQuery;
use ApiRol\Context\Rule\Application\Query\FindRule\FindRuleQueryHandler;
use ApiRol\Context\Rule\Application\Query\FindRule\FindRuleQueryResponse;
use ApiRol\Context\Rule\Application\Query\FindRule\FindRuleQueryResponseConverter;
use ApiRol\Context\Rule\Domain\Write\Aggregate\Rule;
use ApiRol\Context\Rule\Domain\Write\Aggregate\ValueObject\RuleId;
use ApiRol\Context\Rule\Domain\Write\Exception\RuleNotFoundException;
use ApiRol\Context\Rule\Domain\Write\Repository\RuleRepository;
use ApiRol\Tests\Infrastructure\Context\Rule\Domain\Write\Aggregate\RuleStub;
use ApiRol\Tests\Infrastructure\Context\Rule\Domain\Write\Aggregate\ValueObject\RuleIdStub;
use ApiRol\Tests\Infrastructure\Context\Rule\Domain\Write\Repository\RuleRepositoryMock;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophet;

class FindRuleQueryHandlerTest extends TestCase
{
    private RuleRepositoryMock $ruleRepository;
    private FindRuleQueryHandler $handler;

    protected function setUp(): void
    {
        $prophet = new Prophet();
        $this->ruleRepository = new RuleRepositoryMock($prophet->prophesize(RuleRepository::class));
        $this->handler = new FindRuleQueryHandler($this->ruleRepository->reveal(), new FindRuleQueryResponseConverter());
    }

    public function test_it_should_retrieve_rule(): void
    {
        $ruleId = $this->givenARuleId();
        $rule = $this->givenARuleWithId($ruleId);
        $query = $this->givenAQuery($ruleId);
        $this->thenRuleShouldBeFound($ruleId, $rule);
        $queryResponse = $this->whenHandlingQuery($query);

        $this->assertIsArray($queryResponse->result());

        $this->assertEquals($ruleId->value(), $queryResponse->id());
        $this->assertEquals($rule->id()->value(), $queryResponse->id());
    }

    public function test_it_throws_exception_when_rule_is_not_found(): void
    {
        $ruleId = $this->givenARuleId();
        $query = $this->givenAQuery($ruleId);
        $this->thenRuleShouldNotBeFound($ruleId);
        $this->whenHandlingQuery($query);
    }

    private function givenARuleId(): RuleId
    {
        return RuleIdStub::random();
    }

    private function givenARuleWithId(RuleId $ruleId): Rule
    {
        return RuleStub::create($ruleId);
    }

    private function givenAQuery(RuleId $ruleId): FindRuleQuery
    {
        return FindRuleQuery::create($ruleId->value());
    }

    private function whenHandlingQuery(FindRuleQuery $query): FindRuleQueryResponse
    {
        return $this->handler->__invoke($query);
    }

    private function thenRuleShouldBeFound(RuleId $ruleId, Rule $rule): void
    {
        $this->ruleRepository->shouldFind($ruleId, $rule);
    }

    private function thenRuleShouldNotBeFound(RuleId $ruleId): void
    {
        $this->ruleRepository->shouldNotFind($ruleId);
        $this->expectException(RuleNotFoundException::class);
    }
}
