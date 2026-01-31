<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\Application\Command\CreateAbility;

use ApiRol\Context\Character\Domain\Write\Aggregate\Ability;
use ApiRol\Context\Character\Domain\Write\Repository\AbilityRepository;
use ApiRol\Shared\Application\Bus\Command\CommandHandlerInterface;

final readonly class CreateAbilityCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private AbilityRepository $characterRepository
    ) {
    }

    public function __invoke(CreateAbilityCommand $command): void
    {
        $character = Ability::create(
            $command->id(),
            $command->abilityName(),
            $command->abilityDescription(),
            $command->abilityLength(),
            $command->abilityTargetKind(),
            $command->abilityValueKind(),
            $command->abilityValue(),
        );

        $this->characterRepository->save($character);
    }
}
