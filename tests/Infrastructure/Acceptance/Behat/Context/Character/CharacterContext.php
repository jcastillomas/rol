<?php

declare(strict_types=1);

namespace ApiRol\Tests\Infrastructure\Acceptance\Behat\Context\Character;

use ApiRol\Context\Character\Domain\Write\Aggregate\CharacterBase;
use ApiRol\Context\Character\Domain\Write\Aggregate\ValueObject\Character\CharacterId;
use ApiRol\Context\Character\Domain\Write\Repository\CharacterRepository;
use ApiRol\Shared\Domain\Service\Assertion\Assert;
use ApiRol\Tests\DataFixtures\DataLoaders\CharacterFixtures;
use ApiRol\Tests\Infrastructure\Acceptance\Behat\Context\AggregateContext;
use ApiRol\Tests\Infrastructure\Context\Character\Domain\Write\Aggregate\CharacterStub;
use Behat\Gherkin\Node\TableNode;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\HttpKernel\KernelInterface;

final class CharacterContext extends AggregateContext
{
    private ?CommandTester $commandResult = null;

    public function __construct(
        KernelInterface             $kernel,
        private CharacterRepository $characterRepository
    )
    {
        parent::__construct($kernel);
    }

    /**
     * @Given /^I have characters with data$/
     */
    public function iHavaCharactersWithData(TableNode $table): void
    {
        foreach ($table->getHash() as $attributes) {
            foreach ($attributes as $key => $attribute) {
                $attributes[$key] = empty($attribute) ? null : $attribute;
            }

            $id = isset($attributes['id']) ? CharacterId::fromString($attributes['id']) : null;


            $character = CharacterStub::create(
                $id,
            );

            $this->characterRepository->save($character);
        }

        $this->em()->flush();
        $this->em()->clear();
    }

    /**
     * @Given /^I have characters$/
     */
    public function iHaveCharacters(): void
    {
        $this->loadFixtures(new CharacterFixtures());
    }

    /**
     * @Then I should have the following characters:
     */
    public function iShouldHaveFollowingCharacters(TableNode $table)
    {
        $this->em()->clear();
        foreach ($table->getHash() as $characterHash) {
            /** @var CharacterBase $character */
            $character = $this->characterRepository->find(CharacterId::fromString($characterHash['id']));

            Assert::eq($character->id()->value(), $characterHash['id']);
        }
    }

    protected function purge(): void
    {
        $this->purgeTables('character_base');
    }
}
