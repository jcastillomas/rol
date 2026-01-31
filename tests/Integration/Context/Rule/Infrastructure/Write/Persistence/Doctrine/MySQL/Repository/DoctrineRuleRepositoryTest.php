<?php

namespace ApiRol\Tests\Integration\Context\Rule\Infrastructure\Write\Persistence\Doctrine\MySQL\Repository;

use ApiRol\Context\Rule\Domain\Write\Aggregate\Rule;
use ApiRol\Context\Rule\Domain\Write\Aggregate\ValueObject\RuleId;
use ApiRol\Context\Rule\Domain\Write\Exception\RuleNotFoundException;
use ApiRol\Context\Rule\Domain\Write\Repository\RuleRepository;
use ApiRol\Shared\Infrastructure\Persistence\Doctrine\MySQL\Repository\AggregateRepository;
use ApiRol\Tests\Infrastructure\Context\Rule\Domain\Write\Aggregate\RuleStub;
use ApiRol\Tests\Infrastructure\Context\Rule\Domain\Write\Aggregate\ValueObject\RuleIdStub;
use ApiRol\Tests\Infrastructure\Integration\MySQL\AggregateRepositoryTestCase;

class DoctrineRuleRepositoryTest extends AggregateRepositoryTestCase
{
    public function test_it_saves_and_finds_a_rule(): void
    {
        $expectedRule = $this->givenARuleWith();
        $this->whenARuleIsSaved($expectedRule);
        $this->thenARuleIsFound($expectedRule);
    }

    public function test_it_throws_exception_when_rule_is_not_found(): void
    {
        $nonExistingRuleId = $this->givenANonExistingRuleId();
        $this->expectException(RuleNotFoundException::class);
        $this->whenFindingARule($nonExistingRuleId);
    }

    private function givenASavedRule(?\DateTimeImmutable $updatedAt = null, ?\DateTimeImmutable $createdAt = null): Rule
    {
        $rule = RuleStub::create(
            createdAt: $createdAt,
            updatedAt: $updatedAt
        );

        $this->repository->save($rule);

        return $rule;
    }

    private function givenARuleWith(): Rule {
        return RuleStub::create(
            RuleIdStub::random(),
        );
    }

    private function givenANonExistingRuleId(): RuleId
    {
        return RuleIdStub::random();
    }

    private function whenARuleIsSaved(Rule $rule): void
    {
        $this->repository->save($rule);
        $this->em()->flush();
        $this->em()->clear();
    }

    private function whenFindingARule(RuleId $ruleId): Rule
    {
        return $this->repository->find($ruleId);
    }

    private function thenARuleIsFound(
        Rule $expectedRule,
    ): void {
        /** @var Rule $actualRule */
        $actualRule = $this->repository->find($expectedRule->id());
        $this->assertEquals($expectedRule->id(), $actualRule->id());
        $this->assertEquals($expectedRule->createdAt()->getTimestamp(), $actualRule->createdAt()->getTimestamp());
        $this->assertEquals($expectedRule->updatedAt()->getTimestamp(), $actualRule->updatedAt()->getTimestamp());
    }

    protected function repository(): AggregateRepository
    {
        return self::getContainer()->get('test.' . RuleRepository::class);
    }

    protected function purge(): void
    {
        $this->purgeTables('rule');
    }
}
