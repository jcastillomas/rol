<?php

namespace ApiRol\Tests\Unit\Context\Character\Application\Command\CreateCharacter;

use ApiRol\Context\Character\Application\Command\CreateAbility\CreateAbilityCommand;
use ApiRol\Context\Character\Application\Command\CreateAbility\CreateAbilityCommandHandler;
use ApiRol\Context\Character\Domain\Write\Aggregate\Ability;
use ApiRol\Context\Character\Domain\Write\Repository\AbilityRepository;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\AbilityStub;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject\AbilityIdStub;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject\AbilityLengthStub;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject\AbilityTargetKindStub;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject\AbilityValueKindStub;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject\AbilityValueStub;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Repository\AbilityRepositoryMock;
use ApiRol\Tests\Infrastructure\Shared\Domain\ValueObject\DescriptionStub;
use ApiRol\Tests\Infrastructure\Shared\Domain\ValueObject\NameStub;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophet;

class CreateAbilityCommandHandlerTest extends TestCase
{
    private AbilityRepositoryMock $abilityRepository;
    private CreateAbilityCommandHandler $handler;

    protected function setUp(): void
    {
        $prophet = new Prophet();
        $this->abilityRepository = new AbilityRepositoryMock($prophet->prophesize(AbilityRepository::class));
        $this->handler = new CreateAbilityCommandHandler($this->abilityRepository->reveal());
    }

    public function test_it_should_create_a_ability_successfully()
    {
        $command = $this->givenACommand();
        $ability = $this->givenAAbility($command);

        $this->thenAbilityShouldBeSaved($ability);
        $this->whenHandlingCommand($command);

        $this->expectNotToPerformAssertions();
        $this->abilityRepository->mock()->checkProphecyMethodsPredictions();
    }

    private function givenACommand(): CreateAbilityCommand
    {
        return CreateAbilityCommand::create(
            AbilityIdStub::random()->value(),
            NameStub::random()->value(),
            DescriptionStub::random()->value(),
            AbilityLengthStub::random()->value(),
            AbilityTargetKindStub::random()->value,
            AbilityValueKindStub::random()->value,
            AbilityValueStub::random()->value(),
        );
    }

    private function givenAAbility(CreateAbilityCommand $command): Ability
    {
        return AbilityStub::createWithValidNullValues(
            $command->id(),
        );
    }

    private function thenAbilityShouldBeSaved(Ability $ability): void
    {
        $this->abilityRepository->shouldSave($ability);
    }

    private function whenHandlingCommand(CreateAbilityCommand $command): void
    {
        $this->handler->__invoke($command);
    }
}
