<?php

declare(strict_types=1);

namespace ApiRol\Context\Rule\Domain\Write\Aggregate;

use ApiRol\Context\Rule\Domain\Write\Aggregate\ValueObject\RuleId;
use ApiRol\Shared\Domain\Write\Aggregate\AggregateRoot;
use DateTimeImmutable;

class Rule extends AggregateRoot
{
    private DateTimeImmutable $createdAt;
    private ?DateTimeImmutable $updatedAt;

    public static function create(
        RuleId $id,
    ) : self {
        $rule = new self($id);
        $rule->createdAt = new DateTimeImmutable();
        $rule->updatedAt = null;

        return $rule;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function updatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }
}
