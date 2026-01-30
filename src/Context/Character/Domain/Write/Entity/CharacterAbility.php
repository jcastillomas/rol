<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\Domain\Write\Entity;

use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability\AbilityId;
use ApiRol\Context\Character\Domain\Write\Entity\ValueObject\CharacterAbilityId;
use ApiRol\Shared\Domain\Write\Aggregate\Entity;
use DateTimeImmutable;

class CharacterAbility extends Entity
{
    private AbilityId $abilityId;
    private DateTimeImmutable $createdAt;
    private ?DateTimeImmutable $updatedAt;

    public static function create(CharacterAbilityId $id, AbilityId $abilityId): self
    {
        $characterAbility =  new self($id);

        $characterAbility->createdAt = new DateTimeImmutable();
        $characterAbility->updatedAt = null;
        $characterAbility->abilityId = $abilityId;
        return $characterAbility;
    }

    public function abilityId(): AbilityId
    {
        return $this->abilityId;
    }

    public function createdAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function updatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }
}
