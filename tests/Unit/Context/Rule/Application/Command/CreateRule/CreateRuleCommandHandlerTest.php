<?php

namespace ApiRol\Tests\Unit\Context\Rule\Application\Command\CreateRule;

use ApiRol\Context\Rule\Application\Command\CreateRule\CreateRuleCommand;
use ApiRol\Context\Rule\Application\Command\CreateRule\CreateRuleCommandHandler;
use ApiRol\Context\Rule\Domain\Write\Aggregate\Rule;
use ApiRol\Context\Rule\Domain\Write\Repository\RuleRepository;
use ApiRol\Tests\Infrastructure\Context\Rule\Domain\Write\Aggregate\RuleStub;
use ApiRol\Tests\Infrastructure\Context\Rule\Domain\Write\Aggregate\ValueObject\RuleIdStub;
use ApiRol\Tests\Infrastructure\Context\Rule\Domain\Write\Repository\RuleRepositoryMock;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophet;

class CreateRuleCommandHandlerTest extends TestCase
{
    private RuleRepositoryMock $ruleRepository;
    private CreateRuleCommandHandler $handler;

    protected function setUp(): void
    {
        $prophet = new Prophet();
        $this->ruleRepository = new RuleRepositoryMock($prophet->prophesize(RuleRepository::class));
        $this->handler = new CreateRuleCommandHandler($this->ruleRepository->reveal());
    }

    public function test_it_should_create_a_rule_successfully()
    {
        $command = $this->givenACommand();
        $rule = $this->givenARule($command);

        $this->thenRuleShouldBeSaved($rule);
        $this->whenHandlingCommand($command);

        $this->expectNotToPerformAssertions();
        $this->ruleRepository->mock()->checkProphecyMethodsPredictions();
    }

    private function givenACommand(): CreateRuleCommand
    {
        return CreateRuleCommand::create(
            RuleIdStub::random()->value(),
        );
    }

    private function givenARule(CreateRuleCommand $command): Rule
    {
        return RuleStub::createWithValidNullValues(
            $command->id(),
        );
    }

    private function thenRuleShouldBeSaved(Rule $rule): void
    {
        $this->ruleRepository->shouldSave($rule);
    }

    private function thenRuleShouldNotBeSaved(): void
    {
        $this->ruleRepository->shouldNotCallSave();
    }

    private function whenHandlingCommand(CreateRuleCommand $command): void
    {
        $this->handler->__invoke($command);
    }
}
