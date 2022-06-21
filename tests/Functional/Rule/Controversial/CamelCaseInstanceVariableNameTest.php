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
     * Get classes to test.
     *
     * @return (bool|string)[][]
     *
     * @psalm-return array{0: array{0: 'Controversial/CamelCaseInstanceVariableName/RuleDoesApplyForVariableNameWithUnderscore', 1: 'false', 2: true}, 1: array{0: 'Controversial/CamelCaseInstanceVariableName/RuleDoesApplyForVariableNameWithCapital', 1: 'false', 2: true}, 2: array{0: 'Controversial/CamelCaseInstanceVariableName/RuleDoesNotApplyForStaticVariableAccess', 1: 'false', 2: false}, 3: array{0: 'Controversial/CamelCaseInstanceVariableName/RuleDoesNotApplyForValidVariableName', 1: 'false', 2: false}, 4: array{0: 'Controversial/CamelCaseInstanceVariableName/RuleDoesNotApplyForValidVariableNameWithUnderscoreWhenAllowed', 1: 'true', 2: false}}
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
