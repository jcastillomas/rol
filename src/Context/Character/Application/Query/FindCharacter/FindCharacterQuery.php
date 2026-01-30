<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\Application\Query\FindCharacter;

use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Character\CharacterId;
use ApiRol\Shared\Application\Bus\Query\Query;

final class FindCharacterQuery extends Query
{
    private const CHARACTER_ID = 'character_id';

    public static function create(
        string $characterId
    ): self {
        return new self([
            self::CHARACTER_ID => $characterId,
        ]);
    }

    public function characterId(): CharacterId
    {
        return CharacterId::fromString($this->get(self::CHARACTER_ID));
    }

    protected function version(): string
    {
        return '1.0';
    }

    public static function messageName(): string
    {
        return 'query.character.find_character';
    }
}
