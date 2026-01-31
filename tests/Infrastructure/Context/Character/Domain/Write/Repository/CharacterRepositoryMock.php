<?php

declare(strict_types=1);

namespace ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Repository;

use ApiRol\Context\Character\Domain\Write\Aggregate\CharacterBase;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Character\CharacterId;
use ApiRol\Context\Character\Domain\Write\Exception\CharacterNotFoundException;
use ApiRol\Context\Character\Domain\Write\Repository\CharacterRepository;
use ApiRol\Shared\Domain\Service\Assertion\Assert;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;

class CharacterRepositoryMock
{
    private ObjectProphecy|CharacterRepository $mock;

    public function __construct(ObjectProphecy $mock)
    {
        $this->mock = $mock;
    }

    public function reveal(): CharacterRepository
    {
        return $this->mock->reveal();
    }

    public function mock(): CharacterRepository|ObjectProphecy
    {
        return $this->mock;
    }

    public function shouldSave(CharacterBase $expectedCharacter): void
    {
        $this->mock
            ->save(Argument::that(function (CharacterBase $actualCharacter) use ($expectedCharacter) {
                Assert::eq($expectedCharacter->id(), $actualCharacter->id());

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

    public function shouldFind(CharacterId $characterId, CharacterBase $character): void
    {
        $this->mock
            ->find($characterId)
            ->shouldBeCalledOnce()
            ->willReturn($character);
    }

    public function shouldNotFind(CharacterId $characterId): void
    {
        $this->mock
            ->find($characterId)
            ->shouldBeCalledOnce()
            ->willThrow(CharacterNotFoundException::forId($characterId));
    }
}
