<?php

namespace CSoellinger\SilverStripe\PHPMD\Tests\Unit\Rule\Controversial;

use CSoellinger\SilverStripe\PHPMD\Rule\Controversial\CamelCaseInstanceVariableName;
use CSoellinger\SilverStripe\PHPMD\Tests\Unit\TestCase;

/**
 * tbd.
 *
 * @internal
 * @covers \CSoellinger\SilverStripe\PHPMD\Rule\Controversial\CamelCaseInstanceVariableName
 */
class CamelCaseInstanceVariableNameTest extends TestCase
{
    /**
     * @dataProvider getFixtureClassPaths
     */
    public function testRuleCamelCaseInstanceVariableName(string $classPath, bool $allowUnderscore, int $violationNumber): void
    {
        $this->getRule()->setReport($this->getReport($violationNumber));
        $this->getRule()->addProperty('allow-underscore', (string) $allowUnderscore);
        $this->getRule()->apply($this->getClassNode($classPath));
    }

    /**
     * @return array<array{0:string,1:bool,2:int}>
     */
    public function getFixtureClassPaths(): array
    {
        return [
            ['Controversial\\CamelCaseInstanceVariableName\\RuleDoesApplyForVariableNameWithUnderscore', false, 1], // error
            ['Controversial\\CamelCaseInstanceVariableName\\RuleDoesApplyForVariableNameWithCapital', false, 1], // error
            ['Controversial\\CamelCaseInstanceVariableName\\RuleDoesNotApplyForStaticVariableWrite', false, 0], // error
            ['Controversial\\CamelCaseInstanceVariableName\\RuleDoesNotApplyForStaticVariableAccess', false, 0],
            ['Controversial\\CamelCaseInstanceVariableName\\RuleDoesNotApplyForValidVariableName', false, 0],
            ['Controversial\\CamelCaseInstanceVariableName\\RuleDoesNotApplyForValidVariableNameWithUnderscoreWhenAllowed', true, 0],
        ];
    }

    protected function initRule(): CamelCaseInstanceVariableName
    {
        return new CamelCaseInstanceVariableName();
    }
}
