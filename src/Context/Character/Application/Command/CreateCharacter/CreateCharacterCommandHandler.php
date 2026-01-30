<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\Application\Command\CreateCharacter;

use ApiRol\Context\Character\Domain\Write\Aggregate\CharacterBase;
use ApiRol\Context\Character\Domain\Write\Repository\CharacterRepository;
use ApiRol\Shared\Application\Bus\Command\CommandHandlerInterface;

final readonly class CreateCharacterCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private CharacterRepository $doctorRepository
    ) {
    }

    public function __invoke(CreateCharacterCommand $command): void
    {
        $doctor = CharacterBase::create(
            $command->id(),
            $command->characterName(),
            $command->characterDescription(),
            $command->characterLife(),
            $command->characterArmour(),
            $command->characterAttArcanum(),
            $command->characterAttCharisma(),
            $command->characterAttConstitution(),
            $command->characterAttDexterity(),
            $command->characterAttStrength(),
            $command->characterAbilities(),
        );

        $this->doctorRepository->save($doctor);
    }
}
