<?php

declare(strict_types=1);

namespace ApiRol\Context\Rule\UI\Controller\Transformer;

use ApiRol\Context\Rule\Application\Query\FindRule\FindRuleQueryResponse;
use ApiRol\Shared\Application\Bus\Query\Response;
use ApiRol\Shared\UI\Response\HttpResponseTransformer;
use UnexpectedValueException;

final class RuleResponseTransformer extends HttpResponseTransformer
{
    const RULE_ID = 'id';

    protected function transformData(Response $queryResponse): array
    {
        if (!$queryResponse instanceof FindRuleQueryResponse) {
            throw new UnexpectedValueException($queryResponse::class . ' is not a ' . FindRuleQueryResponse::class);
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
