<?php

namespace ApiRol\Tests\Unit\Context\Character\Domain\Write\Aggregate;

use ApiRol\Context\Character\Domain\Write\Aggregate\Ability;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject\AbilityIdStub;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject\AbilityLengthStub;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject\AbilityTargetKindStub;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject\AbilityValueKindStub;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject\AbilityValueStub;
use ApiRol\Tests\Infrastructure\Shared\Domain\ValueObject\DescriptionStub;
use ApiRol\Tests\Infrastructure\Shared\Domain\ValueObject\NameStub;
use PHPUnit\Framework\TestCase;

class AbilityTest extends TestCase
{
    public function test_it_creates_a_character(): void
    {
        $id = AbilityIdStub::random();
        $abilityName = NameStub::random();
        $abilityDescription = DescriptionStub::random();
        $abilityLength = AbilityLengthStub::random();
        $abilityTargetKind = AbilityTargetKindStub::random();
        $abilityValueKind = AbilityValueKindStub::random();
        $abilityValue = AbilityValueStub::random();

        $ability = Ability::create(
            $id,
            $abilityName,
            $abilityDescription,
            $abilityLength,
            $abilityTargetKind,
            $abilityValueKind,
            $abilityValue,
        );

        $this->assertTrue($id->equalsTo($ability->id()));
        $this->assertTrue($abilityName->equalsTo($ability->abilityName()));
        $this->assertTrue($abilityDescription->equalsTo($ability->abilityDescription()));
        $this->assertTrue($abilityLength->equalsTo($ability->abilityLength()));
        $this->assertEquals($abilityTargetKind->value, $ability->abilityTargetKind()->value);
        $this->assertEquals($abilityValueKind->value, $ability->abilityValueKind()->value);
        $this->assertTrue($abilityValue->equalsTo($ability->abilityValue()));
    }
}
