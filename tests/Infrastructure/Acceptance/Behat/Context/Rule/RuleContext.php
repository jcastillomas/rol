<?php

declare(strict_types=1);

namespace ApiRol\Tests\Infrastructure\Acceptance\Behat\Context\Rule;

use ApiRol\Context\Rule\Domain\Write\Aggregate\Rule;
use ApiRol\Context\Rule\Domain\Write\Aggregate\ValueObject\RuleId;
use ApiRol\Context\Rule\Domain\Write\Repository\RuleRepository;
use ApiRol\Shared\Domain\Service\Assertion\Assert;
use ApiRol\Tests\DataFixtures\DataLoaders\RuleFixtures;
use ApiRol\Tests\Infrastructure\Acceptance\Behat\Context\AggregateContext;
use ApiRol\Tests\Infrastructure\Context\Rule\Domain\Write\Aggregate\RuleStub;
use Behat\Gherkin\Node\TableNode;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\HttpKernel\KernelInterface;

final class RuleContext extends AggregateContext
{
    private ?CommandTester $commandResult = null;

    public function __construct(
        KernelInterface $kernel,
        private RuleRepository $ruleRepository
    ) {
        parent::__construct($kernel);
    }

    /**
     * @Given /^I have rules with data$/
     */
    public function iHavaRulesWithData(TableNode $table): void
    {
        foreach ($table->getHash() as $attributes) {
            foreach ($attributes as $key => $attribute) {
                $attributes[$key] = empty($attribute) ? null : $attribute;
            }

            $id        = isset($attributes['id']) ? RuleId::fromString($attributes['id']) : null;


            $rule = RuleStub::create(
                $id,
            );

            $this->ruleRepository->save($rule);
        }

        $this->em()->flush();
        $this->em()->clear();
    }

    /**
     * @Given /^I have rules$/
     */
    public function iHaveRules(): void
    {
        $this->loadFixtures(new RuleFixtures());
    }

    /**
     * @Then I should have the following rules:
     */
    public function iShouldHaveFollowingRules(TableNode $table)
    {
        $this->em()->clear();
        foreach ($table->getHash() as $ruleHash) {
            /** @var Rule $rule */
            $rule = $this->ruleRepository->find(RuleId::fromString($ruleHash['id']));

            Assert::eq($rule->id()->value(), $ruleHash['id']);
        }
    }

    protected function purge(): void
    {
        $this->purgeTables('rule');
    }
}
