<?php

declare(strict_types=1);

namespace ApiRol\Tests\Infrastructure\Context\Rule\Domain\Write\Repository;

use ApiRol\Context\Rule\Domain\Exception\RuleNotFoundException;
use ApiRol\Context\Rule\Domain\Write\Aggregate\Rule;
use ApiRol\Context\Rule\Domain\Write\Aggregate\ValueObject\RuleId;
use ApiRol\Context\Rule\Domain\Write\Repository\RuleRepository;
use ApiRol\Shared\Domain\Service\Assertion\Assert;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;

class RuleRepositoryMock
{
    private ObjectProphecy|RuleRepository $mock;

    public function __construct(ObjectProphecy $mock)
    {
        $this->mock = $mock;
    }

    public function reveal(): RuleRepository
    {
        return $this->mock->reveal();
    }

    public function mock(): RuleRepository|ObjectProphecy
    {
        return $this->mock;
    }

    public function shouldSave(Rule $expectedRule): void
    {
        $this->mock
            ->save(Argument::that(function (Rule $actualRule) use ($expectedRule) {
                Assert::eq($expectedRule->id(), $actualRule->id());

                return true;
            }))
            ->shouldBeCalledOnce();
    }

    public function shouldNotCallSave(): void
    {
        $this->mock
            ->save()
            ->shouldNotBeCalled();
    }

    public function shouldFind(RuleId $ruleId, Rule $rule): void
    {
        $this->mock
            ->find($ruleId)
            ->shouldBeCalledOnce()
            ->willReturn($rule);
    }

    public function shouldNotFind(RuleId $ruleId): void
    {
        $this->mock
            ->find($ruleId)
            ->shouldBeCalledOnce()
            ->willThrow(RuleNotFoundException::forId($ruleId));
    }
}
