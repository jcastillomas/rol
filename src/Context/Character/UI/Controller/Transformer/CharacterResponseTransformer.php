<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\UI\Controller\Transformer;

use ApiRol\Context\Character\Application\Query\FindCharacter\FindCharacterQueryResponse;
use ApiRol\Shared\Application\Bus\Query\Response;
use ApiRol\Shared\UI\Response\HttpResponseTransformer;
use UnexpectedValueException;

final class CharacterResponseTransformer extends HttpResponseTransformer
{
    const RULE_ID = 'id';

    protected function transformData(Response $queryResponse): array
    {
        if (!$queryResponse instanceof FindCharacterQueryResponse) {
            throw new UnexpectedValueException($queryResponse::class . ' is not a ' . FindCharacterQueryResponse::class);
        }

        return [
            self::RULE_ID => $queryResponse->id(),
        ];
    }

    protected function transformMetadata(Response $queryResponse): array
    {
        return array();
    }
}
