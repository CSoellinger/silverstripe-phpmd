<?php

namespace CSoellinger\SilverStripe\PHPMD\Tests\Unit\Rule\Controversial;

use CSoellinger\SilverStripe\PHPMD\Rule\Controversial\CamelCaseInstancePropertyName;
use CSoellinger\SilverStripe\PHPMD\Tests\Unit\TestCase;

/**
 * tbd.
 *
 * @internal
 * @coversNothing
 */
class CamelCaseInstancePropertyNameTest extends TestCase
{
    /**
     * @dataProvider getFixtureClassPaths
     */
    public function testRuleCamelCaseInstancePropertyName(string $classPath, bool $allowUnderscore, int $violationNumber)
    {
        $this->getRule()->setReport($this->getReport($violationNumber));
        $this->getRule()->addProperty('allow-underscore', (string) $allowUnderscore);
        $this->getRule()->apply($this->getClassNode($classPath));
    }

    public function getFixtureClassPaths()
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

    protected function initRule()
    {
        return new CamelCaseInstancePropertyName();
    }
}
