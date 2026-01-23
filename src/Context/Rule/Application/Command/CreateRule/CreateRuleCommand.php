<?php

declare(strict_types=1);

namespace ApiRol\Context\Rule\Application\Command\CreateRule;

use ApiRol\Context\Rule\Domain\Write\Aggregate\ValueObject\RuleId;
use ApiRol\Shared\Application\Bus\Command\Command;

final class CreateRuleCommand extends Command
{
    private const ID = 'id';

    public static function create(
        string $id,
    ): CreateRuleCommand {
        return new self([
            self::ID => $id,
        ]);
    }

    public function id(): RuleId
    {
        return RuleId::fromString($this->get(self::ID));
    }

    protected function version(): string
    {
        return '1.0';
    }

    public static function messageName(): string
    {
        return 'command.rule.create';
    }
}
