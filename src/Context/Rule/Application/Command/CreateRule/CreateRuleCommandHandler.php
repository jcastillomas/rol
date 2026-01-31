<?php

declare(strict_types=1);

namespace ApiRol\Context\Rule\Application\Command\CreateRule;

use ApiRol\Context\Rule\Domain\Write\Aggregate\Rule;
use ApiRol\Context\Rule\Domain\Write\Repository\RuleRepository;
use ApiRol\Shared\Application\Bus\Command\CommandHandlerInterface;

final readonly class CreateRuleCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private RuleRepository $ruleRepository
    ) {
    }

    public function __invoke(CreateRuleCommand $command): void
    {
        $rule = Rule::create(
            $command->id(),
        );

        $this->ruleRepository->save($rule);
    }
}
