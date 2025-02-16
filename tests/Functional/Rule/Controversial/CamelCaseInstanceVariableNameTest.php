<?php

namespace CSoellinger\SilverStripe\PHPMD\Tests\Functional\Rule\Controversial;

use CSoellinger\SilverStripe\PHPMD\Rule\Controversial\CamelCaseInstancePropertyName;
use CSoellinger\SilverStripe\PHPMD\Rule\Controversial\CamelCaseInstanceVariableName;
use CSoellinger\SilverStripe\PHPMD\Tests\Functional\TestCase;

/**
 * tbd.
 *
 * @internal
 * @covers CSoellinger\SilverStripe\PHPMD\Rule\Controversial\CamelCaseInstanceVariableName
 */
class CamelCaseInstanceVariableNameTest extends TestCase
{
    const VIOLATION_OUTPUT = 'CamelCaseInstanceVariableName  The instance variable ';

    /**
     * @dataProvider getFixtureClassPaths
     */
    public function testRuleCamelCaseInstanceVariableName(string $file, string $allowUnderscore, bool $violation): void
    {
        $this->rulesetProperties = ['CamelCaseInstanceVariableName' => ['allow-underscore' => $allowUnderscore]];

        $this->testFile($file, $violation);
    }

    /**
     * @return array<array{0:string,1:string,2:bool}>
     */
    public function getFixtureClassPaths(): array
    {
        return [
            ['Controversial/CamelCaseInstanceVariableName/RuleDoesApplyForVariableNameWithUnderscore', 'false', true], // error
            ['Controversial/CamelCaseInstanceVariableName/RuleDoesApplyForVariableNameWithCapital', 'false', true], // error
            ['Controversial/CamelCaseInstanceVariableName/RuleDoesNotApplyForStaticVariableAccess', 'false', false],
            ['Controversial/CamelCaseInstanceVariableName/RuleDoesNotApplyForValidVariableName', 'false', false],
            ['Controversial/CamelCaseInstanceVariableName/RuleDoesNotApplyForValidVariableNameWithUnderscoreWhenAllowed', 'true', false],
        ];
    }

    public function getViolationOutput(): string
    {
        return self::VIOLATION_OUTPUT;
    }
}
