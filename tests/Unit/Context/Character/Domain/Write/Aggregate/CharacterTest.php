<?php

namespace ApiRol\Tests\Unit\Context\Character\Domain\Write\Aggregate;

use ApiRol\Context\Character\Domain\Write\Aggregate\CharacterBase;
use ApiRol\Context\Character\Domain\Write\Entity\CharacterAbilities;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject\CharacterArmourStub;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject\CharacterAttributeStub;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject\CharacterIdStub;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\ValueObject\CharacterLifeStub;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Entity\CharacterAbilityStub;
use ApiRol\Tests\Infrastructure\Shared\Domain\ValueObject\DescriptionStub;
use ApiRol\Tests\Infrastructure\Shared\Domain\ValueObject\NameStub;
use PHPUnit\Framework\TestCase;

class CharacterTest extends TestCase
{
    public function test_it_creates_a_character(): void
    {
        $id = CharacterIdStub::random();
        $characterName = NameStub::random();
        $characterDescription = DescriptionStub::random();
        $characterLife = CharacterLifeStub::random();
        $characterArmour = CharacterArmourStub::random();
        $characterAttArcanum = CharacterAttributeStub::random();
        $characterAttCharisma = CharacterAttributeStub::random();
        $characterAttConstitution = CharacterAttributeStub::random();
        $characterAttDexterity = CharacterAttributeStub::random();
        $characterAttStrength = CharacterAttributeStub::random();
        $characterAbilities = CharacterAbilities::create([CharacterAbilityStub::random()]);

        $character = CharacterBase::create(
            $id,
            $characterName,
            $characterDescription,
            $characterLife,
            $characterArmour,
            $characterAttArcanum,
            $characterAttCharisma,
            $characterAttConstitution,
            $characterAttDexterity,
            $characterAttStrength,
            $characterAbilities
        );


        $this->assertTrue($id->equalsTo($character->id()));
        $this->assertTrue($characterName->equalsTo($character->characterName()));
        $this->assertTrue($characterDescription->equalsTo($character->characterDescription()));
        $this->assertTrue($characterLife->equalsTo($character->characterLife()));
        $this->assertTrue($characterArmour->equalsTo($character->characterArmour()));
        $this->assertTrue($characterAttArcanum->equalsTo($character->characterAttArcanum()));
        $this->assertTrue($characterAttCharisma->equalsTo($character->characterAttCharisma()));
        $this->assertTrue($characterAttConstitution->equalsTo($character->characterAttConstitution()));
        $this->assertTrue($characterAttDexterity->equalsTo($character->characterAttDexterity()));
        $this->assertTrue($characterAttStrength->equalsTo($character->characterAttStrength()));
        $this->assertEquals($characterAbilities->count(), $character->characterAbilities()->count());
    }
}
