<?php

declare(strict_types=1);

namespace ApiRol\Context\Rule\Infrastructure\Write\Persistence\Doctrine\MySQL\Repository;

use ApiRol\Context\Rule\Domain\Write\Aggregate\Rule;
use ApiRol\Context\Rule\Domain\Write\Aggregate\ValueObject\RuleId;
use ApiRol\Context\Rule\Domain\Write\Exception\RuleNotFoundException;
use ApiRol\Context\Rule\Domain\Write\Repository\RuleRepository;
use ApiRol\Shared\Domain\Write\Exception\AggregateNotFoundException;
use ApiRol\Shared\Infrastructure\Persistence\Doctrine\MySQL\Repository\AggregateRepository;

final class DoctrineRuleRepository extends AggregateRepository implements RuleRepository
{
    public function save(Rule $rule): void
    {
        $this->saveAggregate($rule);
    }

    public function find(RuleId $id): Rule
    {
        try {
            return $this->doFind($id);
        } catch (AggregateNotFoundException $e) {
            throw RuleNotFoundException::forId($id);
        }
    }

    protected function entityClassName(): string
    {
        return Rule::class;
    }
}
