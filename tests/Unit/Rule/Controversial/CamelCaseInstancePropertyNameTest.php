<?php

namespace CSoellinger\SilverStripe\PHPMD\Tests\Unit\Rule\Controversial;

use CSoellinger\SilverStripe\PHPMD\Rule\Controversial\CamelCaseInstancePropertyName;
use CSoellinger\SilverStripe\PHPMD\Tests\Unit\TestCase;

/**
 * tbd.
 *
 * @internal
 * @covers CSoellinger\SilverStripe\PHPMD\Rule\Controversial\CamelCaseInstancePropertyName
 */
class CamelCaseInstancePropertyNameTest extends TestCase
{
    /**
     * @dataProvider getFixtureClassPaths
     */
    public function testRuleCamelCaseInstancePropertyName(string $classPath, bool $allowUnderscore, int $violationNumber): void
    {
        $this->getRule()->setReport($this->getReport($violationNumber));
        $this->getRule()->addProperty('allow-underscore', (string) $allowUnderscore);
        $this->getRule()->apply($this->getClassNode($classPath));
    }

    /**
     * @return (bool|int|string)[][]
     *
     * @psalm-return array{0: array{0: 'Controversial\CamelCaseInstancePropertyName\RuleDoesApplyForPropertyNameWithCapital', 1: false, 2: 1}, 1: array{0: 'Controversial\CamelCaseInstancePropertyName\RuleDoesApplyForPropertyNameWithUnderscores', 1: false, 2: 1}, 2: array{0: 'Controversial\CamelCaseInstancePropertyName\RuleDoesApplyForValidPropertyNameWithUnderscoreWhenNotAllowed', 1: false, 2: 1}, 3: array{0: 'Controversial\CamelCaseInstancePropertyName\RuleDoesNotApplyForValidPropertyName', 1: false, 2: 0}, 4: array{0: 'Controversial\CamelCaseInstancePropertyName\RuleDoesNotApplyForStaticPropertyNameWithUnderscores', 1: false, 2: 0}, 5: array{0: 'Controversial\CamelCaseInstancePropertyName\RuleDoesNotApplyForValidPropertyNameWithNoUnderscoreWhenAllowed', 1: false, 2: 0}, 6: array{0: 'Controversial\CamelCaseInstancePropertyName\RuleDoesNotApplyForValidPropertyNameWithUnderscoreWhenAllowed', 1: true, 2: 0}}
     */
    public function getFixtureClassPaths(): array
    {
        return [
            ['Controversial\\CamelCaseInstancePropertyName\\RuleDoesApplyForPropertyNameWithCapital', false, 1],
            ['Controversial\\CamelCaseInstancePropertyName\\RuleDoesApplyForPropertyNameWithUnderscores', false, 1],
            ['Controversial\\CamelCaseInstancePropertyName\\RuleDoesApplyForValidPropertyNameWithUnderscoreWhenNotAllowed', false, 1],
            ['Controversial\\CamelCaseInstancePropertyName\\RuleDoesNotApplyForValidPropertyName', false, 0], //
            ['Controversial\\CamelCaseInstancePropertyName\\RuleDoesNotApplyForStaticPropertyNameWithUnderscores', false, 0],
            ['Controversial\\CamelCaseInstancePropertyName\\RuleDoesNotApplyForValidPropertyNameWithNoUnderscoreWhenAllowed', false, 0],
            ['Controversial\\CamelCaseInstancePropertyName\\RuleDoesNotApplyForValidPropertyNameWithUnderscoreWhenAllowed', true, 0],
        ];
    }

    protected function initRule(): CamelCaseInstancePropertyName
    {
        return new CamelCaseInstancePropertyName();
    }
}
