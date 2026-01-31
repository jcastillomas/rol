<?php

declare(strict_types=1);

namespace ApiRol\Context\Character\UI\Controller\Transformer;

use ApiRol\Context\Character\Application\Query\FindAbility\FindAbilityQueryResponse;
use ApiRol\Shared\Application\Bus\Query\Response;
use ApiRol\Shared\UI\Response\HttpResponseTransformer;
use UnexpectedValueException;

final class AbilityResponseTransformer extends HttpResponseTransformer
{
    const RULE_ID = 'id';

    protected function transformData(Response $queryResponse): array
    {
        if (!$queryResponse instanceof FindAbilityQueryResponse) {
            throw new UnexpectedValueException($queryResponse::class . ' is not a ' . FindAbilityQueryResponse::class);
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
