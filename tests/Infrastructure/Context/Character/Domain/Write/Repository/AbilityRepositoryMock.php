<?php

declare(strict_types=1);

namespace ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Repository;

use ApiRol\Context\Character\Domain\Write\Aggregate\Ability;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability\AbilityId;
use ApiRol\Context\Character\Domain\Write\Exception\AbilityNotFoundException;
use ApiRol\Context\Character\Domain\Write\Repository\AbilityRepository;
use ApiRol\Shared\Domain\Service\Assertion\Assert;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;

class AbilityRepositoryMock
{
    private ObjectProphecy|AbilityRepository $mock;

    public function __construct(ObjectProphecy $mock)
    {
        $this->mock = $mock;
    }

    public function reveal(): AbilityRepository
    {
        return $this->mock->reveal();
    }

    public function mock(): AbilityRepository|ObjectProphecy
    {
        return $this->mock;
    }

    public function shouldSave(Ability $expectedAbility): void
    {
        $this->mock
            ->save(Argument::that(function (Ability $actualAbility) use ($expectedAbility) {
                Assert::eq($expectedAbility->id(), $actualAbility->id());

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

    public function shouldFind(AbilityId $abilityId, Ability $ability): void
    {
        $this->mock
            ->find($abilityId)
            ->shouldBeCalledOnce()
            ->willReturn($ability);
    }

    public function shouldNotFind(AbilityId $abilityId): void
    {
        $this->mock
            ->find($abilityId)
            ->shouldBeCalledOnce()
            ->willThrow(AbilityNotFoundException::forId($abilityId));
    }
}
