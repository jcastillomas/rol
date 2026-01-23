<?php

declare(strict_types=1);

namespace ApiRol\Tests\Infrastructure\Context\Rule\Domain\Write\Aggregate;

use ApiRol\Context\Rule\Domain\Write\Aggregate\Rule;
use ApiRol\Context\Rule\Domain\Write\Aggregate\ValueObject\RuleId;
use ApiRol\Shared\Domain\Service\ReflectionManager;
use ApiRol\Tests\Infrastructure\Context\Rule\Domain\Write\Aggregate\ValueObject\RuleIdStub;
use ApiRol\Tests\Infrastructure\Shared\Domain\ValueObject\DateTimeImmutableStub;
use DateTimeImmutable;

final class RuleStub
{
    public static function create(
        ?RuleId            $id = null,
        ?DateTimeImmutable $createdAt = null,
        ?DateTimeImmutable $updatedAt = null,
    ): Rule
    {
        $rm = ReflectionManager::create();

        return $rm->buildObject(
            Rule::class,
            [
                'id' => $id ?? RuleIdStub::random(),
                'createdAt' => $createdAt ?? DateTimeImmutableStub::yesterday(),
                'updatedAt' => $updatedAt ?? DateTimeImmutableStub::now(),
            ]
        );
    }

    public static function createWithValidNullValues(
        ?RuleId                        $id = null,
        ?DateTimeImmutable             $createdAt = null,
        ?DateTimeImmutable             $updatedAt = null,
    ): Rule
    {
        $rm = ReflectionManager::create();

        return $rm->buildObject(
            Rule::class,
            [
                'id' => $id ?? RuleIdStub::random(),
                'createdAt' => $createdAt ?? DateTimeImmutableStub::yesterday(),
                'updatedAt' => $updatedAt,
            ]
        );
    }

    public static function random(): Rule
    {
        return self::create();
    }
}
