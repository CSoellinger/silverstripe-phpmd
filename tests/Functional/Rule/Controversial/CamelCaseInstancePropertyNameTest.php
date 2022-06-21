<?php

namespace CSoellinger\SilverStripe\PHPMD\Tests\Functional\Rule\Controversial;

use CSoellinger\SilverStripe\PHPMD\Tests\Functional\TestCase;

/**
 * tbd.
 *
 * @internal
 * @covers \CSoellinger\SilverStripe\PHPMD\Rule\Controversial\CamelCaseInstancePropertyName
 */
class CamelCaseInstancePropertyNameTest extends TestCase
{
    public const VIOLATION_OUTPUT = 'CamelCaseInstancePropertyName  The instance property ';

    /**
     * @dataProvider getFixtureClassPaths
     */
    public function testRuleCamelCaseInstancePropertyName(string $file, string $allowUnderscore, bool $violation): void
    {
        $this->rulesetProperties = ['CamelCaseInstancePropertyName' => ['allow-underscore' => $allowUnderscore]];

        $this->testFile($file, $violation);
    }

    /**
     * Get classes to test.
     *
     * @return (bool|string)[][]
     *
     * @psalm-return array{0: array{0: 'Controversial/CamelCaseInstancePropertyName/RuleDoesApplyForPropertyNameWithCapital', 1: 'false', 2: true}, 1: array{0: 'Controversial/CamelCaseInstancePropertyName/RuleDoesApplyForPropertyNameWithUnderscores', 1: 'false', 2: true}, 2: array{0: 'Controversial/CamelCaseInstancePropertyName/RuleDoesApplyForValidPropertyNameWithUnderscoreWhenNotAllowed', 1: 'false', 2: true}, 3: array{0: 'Controversial/CamelCaseInstancePropertyName/RuleDoesNotApplyForValidPropertyName', 1: 'false', 2: false}, 4: array{0: 'Controversial/CamelCaseInstancePropertyName/RuleDoesNotApplyForStaticPropertyNameWithUnderscores', 1: 'false', 2: false}, 5: array{0: 'Controversial/CamelCaseInstancePropertyName/RuleDoesNotApplyForValidPropertyNameWithNoUnderscoreWhenAllowed', 1: 'false', 2: false}, 6: array{0: 'Controversial/CamelCaseInstancePropertyName/RuleDoesNotApplyForValidPropertyNameWithUnderscoreWhenAllowed', 1: 'true', 2: false}}
     */
    public function getFixtureClassPaths(): array
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
