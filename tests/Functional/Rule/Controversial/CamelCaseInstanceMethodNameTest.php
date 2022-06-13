<?php

namespace CSoellinger\SilverStripe\PHPMD\Tests\Functional\Rule\Controversial;

use CSoellinger\SilverStripe\PHPMD\Rule\Controversial\CamelCaseInstanceMethodName;
use CSoellinger\SilverStripe\PHPMD\Tests\Functional\TestCase;

/**
 * tbd.
 *
 * @internal
 * @covers CSoellinger\SilverStripe\PHPMD\Rule\Controversial\CamelCaseInstanceMethodName
 */
class CamelCaseInstanceMethodNameTest extends TestCase
{
    const VIOLATION_OUTPUT = 'CamelCaseInstanceMethodName  The instance method ';

    /**
     * @dataProvider getFixtureClassPaths
     */
    public function testRuleCamelCaseInstanceMethodName(string $file, $allowUnderscore, $allowUnderscoreTest, bool $violation)
    {
        $this->rulesetProperties = ['CamelCaseInstanceMethodName' => ['allow-underscore' => $allowUnderscore, 'allow-underscore-test' => $allowUnderscoreTest]];

        $this->testFile($file, $violation);
    }

    public function getFixtureClassPaths()
    {
        return [
            [
                'Controversial/CamelCaseInstanceMethodName/RuleAppliesToTestMethodWithTwoConsecutiveUnderscoresWhenAllowed',
                'false',
                'true',
                true,
            ],
            [
                'Controversial/CamelCaseInstanceMethodName/RuleAppliesToTestMethodWithUnderscoreFollowedByCapital',
                'false',
                'false',
                true,
            ],
            [
                'Controversial/CamelCaseInstanceMethodName/RuleDoesApplyForMethodNameWithCapital',
                'false',
                'false',
                true,
            ],
            [
                'Controversial/CamelCaseInstanceMethodName/RuleDoesApplyForMethodNameWithUnderscores',
                'false',
                'false',
                true,
            ],
            [
                'Controversial/CamelCaseInstanceMethodName/RuleDoesApplyForTestMethodWithUnderscoreWhenNotAllowed',
                'false',
                'false',
                true,
            ],
            [
                'Controversial/CamelCaseInstanceMethodName/RuleDoesApplyForValidMethodNameWithUnderscoreWhenNotAllowed',
                'false',
                'false',
                true,
            ],
            // [
            //     'Controversial/CamelCaseInstanceMethodName/RuleDoesNotApplyForMagicMethods',
            //     'false',
            //     'false',
            //     false,
            // ],
            [
                'Controversial/CamelCaseInstanceMethodName/RuleDoesNotApplyForStaticMethodNameWithUnderscores',
                'false',
                'false',
                false,
            ],
            [
                'Controversial/CamelCaseInstanceMethodName/RuleDoesNotApplyForTestMethodWithMultipleUnderscoresWhenAllowed',
                'false',
                'true',
                false,
            ],
            [
                'Controversial/CamelCaseInstanceMethodName/RuleDoesNotApplyForTestMethodWithUnderscoreWhenAllowed',
                'false',
                'true',
                false,
            ],
            [
                'Controversial/CamelCaseInstanceMethodName/RuleDoesNotApplyForValidMethodName',
                'false',
                'false',
                false,
            ],
            [
                'Controversial/CamelCaseInstanceMethodName/RuleDoesNotApplyForValidMethodNameWithUnderscoreWhenAllowed',
                'true',
                'false',
                false,
            ],
            // [
            //     'Controversial/CamelCaseInstanceMethodName/RuleAppliesToTestMethodWithTwoConsecutiveUnderscoresWhenAllowed',
            //     'true',
            // ],
            // [
            //     'Controversial/CamelCaseInstanceMethodName/RuleAppliesToTestMethodWithUnderscoreFollowedByCapital',
            //     'true',
            // ],
            // [
            //     'Controversial/CamelCaseInstanceMethodName/RuleDoesApplyForMethodNameWithCapital',
            //     'true',
            // ],
            // [
            //     'Controversial/CamelCaseInstanceMethodName/RuleDoesApplyForMethodNameWithUnderscores',
            //     'true',
            // ],
            // [
            //     'Controversial/CamelCaseInstanceMethodName/RuleDoesApplyForTestMethodWithUnderscoreWhenNotAllowed',
            //     'true',
            // ],
            // [
            //     'Controversial/CamelCaseInstanceMethodName/RuleDoesApplyForValidMethodNameWithUnderscoreWhenNotAllowed',
            //     'true',
            // ],
            // // [
            // //     'Controversial/CamelCaseInstanceMethodName/RuleDoesNotApplyForMagicMethods',
            // //     'false',
            // // ],
            // [
            //     'Controversial/CamelCaseInstanceMethodName/RuleDoesNotApplyForStaticMethodNameWithUnderscores',
            //     'false',
            // ],
            // // [
            // //     'Controversial/CamelCaseInstanceMethodName/RuleDoesNotApplyForTestMethodWithMultipleUnderscoresWhenAllowed',
            // //     'false',
            // // ],
            // // [
            // //     'Controversial/CamelCaseInstanceMethodName/RuleDoesNotApplyForTestMethodWithUnderscoreWhenAllowed',
            // //     'false',
            // // ],
            // [
            //     'Controversial/CamelCaseInstanceMethodName/RuleDoesNotApplyForValidMethodName',
            //     'false',
            // ],
            // // [
            // //     'Controversial/CamelCaseInstanceMethodName/RuleDoesNotApplyForValidMethodNameWithUnderscoreWhenAllowed',
            // //     'false',
            // // ],
        ];
    }

    public function getViolationOutput(): string
    {
        return self::VIOLATION_OUTPUT;
    }
}
