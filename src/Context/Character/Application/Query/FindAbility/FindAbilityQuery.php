<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\Application\Query\FindAbility;

use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Ability\AbilityId;
use ApiRol\Shared\Application\Bus\Query\Query;

final class FindAbilityQuery extends Query
{
    private const ABILITY_ID = 'ability_id';

    public static function create(
        string $abilityId
    ): self {
        return new self([
            self::ABILITY_ID => $abilityId,
        ]);
    }

    public function abilityId(): AbilityId
    {
        return AbilityId::fromString($this->get(self::ABILITY_ID));
    }

    protected function version(): string
    {
        return '1.0';
    }

    public static function messageName(): string
    {
        return 'query.ability.find_ability';
    }
}
