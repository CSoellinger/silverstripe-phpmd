<?php

namespace CSoellinger\SilverStripe\PHPMD\Tests\Unit\Rule\Controversial;

use CSoellinger\SilverStripe\PHPMD\Rule\Controversial\CamelCaseInstanceVariableName;
use CSoellinger\SilverStripe\PHPMD\Tests\Unit\TestCase;

/**
 * tbd.
 *
 * @internal
 * @covers CSoellinger\SilverStripe\PHPMD\Rule\Controversial\CamelCaseInstanceVariableName
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
     * @return (bool|int|string)[][]
     *
     * @psalm-return array{0: array{0: 'Controversial\CamelCaseInstanceVariableName\RuleDoesApplyForVariableNameWithUnderscore', 1: false, 2: 1}, 1: array{0: 'Controversial\CamelCaseInstanceVariableName\RuleDoesApplyForVariableNameWithCapital', 1: false, 2: 1}, 2: array{0: 'Controversial\CamelCaseInstanceVariableName\RuleDoesNotApplyForStaticVariableWrite', 1: false, 2: 0}, 3: array{0: 'Controversial\CamelCaseInstanceVariableName\RuleDoesNotApplyForStaticVariableAccess', 1: false, 2: 0}, 4: array{0: 'Controversial\CamelCaseInstanceVariableName\RuleDoesNotApplyForValidVariableName', 1: false, 2: 0}, 5: array{0: 'Controversial\CamelCaseInstanceVariableName\RuleDoesNotApplyForValidVariableNameWithUnderscoreWhenAllowed', 1: true, 2: 0}}
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
