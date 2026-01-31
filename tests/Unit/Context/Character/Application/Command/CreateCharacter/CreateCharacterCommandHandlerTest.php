<?php

namespace ApiRol\Tests\Unit\Context\Character\Application\Command\CreateCharacter;

use ApiRol\Context\Character\Application\Command\CreateCharacter\CreateCharacterCommand;
use ApiRol\Context\Character\Application\Command\CreateCharacter\CreateCharacterCommandHandler;
use ApiRol\Context\Character\Domain\Write\Aggregate\CharacterBase;
use ApiRol\Context\Character\Domain\Write\Entity\CharacterAbilities;
use ApiRol\Context\Character\Domain\Write\Repository\CharacterRepository;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\CharacterStub;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject\AbilityIdStub;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject\CharacterArmourStub;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject\CharacterAttributeStub;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject\CharacterIdStub;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject\CharacterLifeStub;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Entity\ValueObject\CharacterAbilityIdStub;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Repository\CharacterRepositoryMock;
use ApiRol\Tests\Infrastructure\Shared\Domain\ValueObject\DescriptionStub;
use ApiRol\Tests\Infrastructure\Shared\Domain\ValueObject\NameStub;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophet;

class CreateCharacterCommandHandlerTest extends TestCase
{
    private CharacterRepositoryMock $characterRepository;
    private CreateCharacterCommandHandler $handler;

    protected function setUp(): void
    {
        $prophet = new Prophet();
        $this->characterRepository = new CharacterRepositoryMock($prophet->prophesize(CharacterRepository::class));
        $this->handler = new CreateCharacterCommandHandler($this->characterRepository->reveal());
    }

    public function test_it_should_create_a_character_successfully()
    {
        $command = $this->givenACommand();
        $character = $this->givenACharacter($command);

        $this->thenCharacterShouldBeSaved($character);
        $this->whenHandlingCommand($command);

        $this->expectNotToPerformAssertions();
        $this->characterRepository->mock()->checkProphecyMethodsPredictions();
    }

    private function givenACommand(): CreateCharacterCommand
    {
        return CreateCharacterCommand::create(
            CharacterIdStub::random()->value(),
            NameStub::random()->value(),
            DescriptionStub::random()->value(),
            CharacterLifeStub::random()->value(),
            CharacterArmourStub::random()->value(),
            CharacterAttributeStub::random()->value(),
            CharacterAttributeStub::random()->value(),
            CharacterAttributeStub::random()->value(),
            CharacterAttributeStub::random()->value(),
            CharacterAttributeStub::random()->value(),
            [
                [
                    'characterAbilityId' => CharacterAbilityIdStub::random()->value(),
                    'abilityId' => AbilityIdStub::random()->value(),
                ]
            ],
        );
    }

    private function givenACharacter(CreateCharacterCommand $command): CharacterBase
    {
        return CharacterStub::createWithValidNullValues(
            $command->id(),
        );
    }

    private function thenCharacterShouldBeSaved(CharacterBase $character): void
    {
        $this->characterRepository->shouldSave($character);
    }

    private function whenHandlingCommand(CreateCharacterCommand $command): void
    {
        $this->handler->__invoke($command);
    }
}
