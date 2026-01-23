<?php

declare(strict_types=1);

namespace ApiRol\Context\Rule\Application\Query\FindRule;

use ApiRol\Shared\Application\Bus\Query\Response;

final class FindRuleQueryResponse implements Response
{
    const ID = 'id';

    public function __construct(private array $result)
    {
    }

    public function result(): array
    {
        return $this->result;
    }

    public function id(): string
    {
        return $this->result[self::ID];
    }
}
