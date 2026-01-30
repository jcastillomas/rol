<?php

namespace ApiRol\Tests\Unit\Context\Rule\Domain\Write\Aggregate;

use ApiRol\Context\Rule\Domain\Write\Aggregate\Rule;
use ApiRol\Tests\Infrastructure\Context\Rule\Domain\Write\Aggregate\ValueObject\RuleIdStub;
use PHPUnit\Framework\TestCase;

class RuleTest extends TestCase
{
    public function test_it_creates_a_rule(): void
    {
        $id = RuleIdStub::random();

        $rule = Rule::create(
            $id,
        );


        $this->assertTrue($id->equalsTo($rule->id()));
    }
}
