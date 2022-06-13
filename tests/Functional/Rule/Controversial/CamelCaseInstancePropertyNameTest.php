<?php

namespace CSoellinger\SilverStripe\PHPMD\Tests\Functional\Rule\Controversial;

use CSoellinger\SilverStripe\PHPMD\Tests\Functional\TestCase;

/**
 * tbd.
 *
 * @internal
 * @covers CSoellinger\SilverStripe\PHPMD\Rule\Controversial\CamelCaseInstancePropertyName
 */
class CamelCaseInstancePropertyNameTest extends TestCase
{
    public const VIOLATION_OUTPUT = 'CamelCaseInstancePropertyName  The instance property ';

    /**
     * @dataProvider getFixtureClassPaths
     */
    public function testRuleCamelCaseInstancePropertyName(string $file, string $allowUnderscore, bool $violation)
    {
        $this->rulesetProperties = ['CamelCaseInstancePropertyName' => ['allow-underscore' => $allowUnderscore]];

        $this->testFile($file, $violation);
    }

    public function getFixtureClassPaths()
    {
        return [
            ['Controversial/CamelCaseInstancePropertyName/RuleDoesApplyForPropertyNameWithCapital', 'false', true],
            ['Controversial/CamelCaseInstancePropertyName/RuleDoesApplyForPropertyNameWithUnderscores', 'false', true],
            ['Controversial/CamelCaseInstancePropertyName/RuleDoesApplyForValidPropertyNameWithUnderscoreWhenNotAllowed', 'false', true],
            ['Controversial/CamelCaseInstancePropertyName/RuleDoesNotApplyForValidPropertyName', 'false', false],
            ['Controversial/CamelCaseInstancePropertyName/RuleDoesNotApplyForStaticPropertyNameWithUnderscores', 'false', false],
            ['Controversial/CamelCaseInstancePropertyName/RuleDoesNotApplyForValidPropertyNameWithNoUnderscoreWhenAllowed', 'false', false],
            ['Controversial/CamelCaseInstancePropertyName/RuleDoesNotApplyForValidPropertyNameWithUnderscoreWhenAllowed', 'true', false],
        ];
    }

    public function getViolationOutput(): string
    {
        return self::VIOLATION_OUTPUT;
    }
}
