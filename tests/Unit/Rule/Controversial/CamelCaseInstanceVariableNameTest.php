<?php

namespace CSoellinger\SilverStripe\PHPMD\Tests\Unit\Rule\Controversial;

use CSoellinger\SilverStripe\PHPMD\Rule\Controversial\CamelCaseInstancePropertyName;
use CSoellinger\SilverStripe\PHPMD\Rule\Controversial\CamelCaseInstanceVariableName;
use CSoellinger\SilverStripe\PHPMD\Tests\Unit\TestCase;

/**
 * tbd.
 *
 * @internal
 * @coversNothing
 */
class CamelCaseInstanceVariableNameTest extends TestCase
{
    /**
     * @dataProvider getFixtureClassPaths
     */
    public function testRuleCamelCaseInstanceVariableName(string $classPath, bool $allowUnderscore, int $violationNumber)
    {
        $this->getRule()->setReport($this->getReport($violationNumber));
        $this->getRule()->addProperty('allow-underscore', (string) $allowUnderscore);
        $this->getRule()->apply($this->getClassNode($classPath));
    }

    public function getFixtureClassPaths()
    {
        return [
            ['Controversial\\CamelCaseInstanceVariableName\\RuleDoesApplyForVariableNameWithUnderscore', false, 1], // error
            ['Controversial\\CamelCaseInstanceVariableName\\RuleDoesApplyForVariableNameWithCapital', false, 1], // error
            ['Controversial\\CamelCaseInstanceVariableName\\RuleDoesNotApplyForStaticVariableAccess', false, 0],
            ['Controversial\\CamelCaseInstanceVariableName\\RuleDoesNotApplyForValidVariableName', false, 0],
            ['Controversial\\CamelCaseInstanceVariableName\\RuleDoesNotApplyForValidVariableNameWithUnderscoreWhenAllowed', true, 0],
        ];
    }

    protected function initRule()
    {
        return new CamelCaseInstanceVariableName();
    }
}
