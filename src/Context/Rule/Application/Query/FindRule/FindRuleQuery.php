<?php

declare(strict_types=1);

namespace ApiRol\Context\Rule\Application\Query\FindRule;

use ApiRol\Context\Rule\Domain\Write\Aggregate\ValueObject\RuleId;
use ApiRol\Shared\Application\Bus\Query\Query;

final class FindRuleQuery extends Query
{
    private const RULE_ID = 'rule_id';

    public static function create(
        string $ruleId
    ): self {
        return new self([
            self::RULE_ID => $ruleId,
        ]);
    }

    public function ruleId(): RuleId
    {
        return RuleId::fromString($this->get(self::RULE_ID));
    }

    protected function version(): string
    {
        return '1.0';
    }

    public static function messageName(): string
    {
        return 'query.rule.find_rule';
    }
}
