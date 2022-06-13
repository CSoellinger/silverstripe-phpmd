<?php

namespace CSoellinger\SilverStripe\PHPMD\Tests\Unit\Rule\Controversial;

use CSoellinger\SilverStripe\PHPMD\Rule\Controversial\CamelCaseInstanceMethodName;
use CSoellinger\SilverStripe\PHPMD\Tests\Unit\TestCase;

/**
 * tbd.
 *
 * @internal
 * @covers CSoellinger\SilverStripe\PHPMD\Rule\Controversial\CamelCaseInstanceMethodName
 */
class CamelCaseInstanceMethodNameTest extends TestCase
{
    /**
     * @dataProvider getFixtureClassPaths
     *
     * @param mixed $config
     */
    public function testRuleCamelCaseInstanceMethodName($classPath, $allowUnderscore, $allowUnderscoreTest, $violationNumber)
    {
        $this->getRule()->setReport($this->getReport($violationNumber));
        $this->getRule()->addProperty('allow-underscore', (string) $allowUnderscore);
        $this->getRule()->addProperty('allow-underscore-test', (string) $allowUnderscoreTest);
        $this->getRule()->apply($this->getMethod($classPath));
    }

    public function getFixtureClassPaths()
    {
        return [
            [
                'Controversial\\CamelCaseInstanceMethodName\\RuleAppliesToTestMethodWithTwoConsecutiveUnderscoresWhenAllowed',
                false,
                true,
                1,
            ],
            [
                'Controversial\\CamelCaseInstanceMethodName\\RuleAppliesToTestMethodWithUnderscoreFollowedByCapital',
                false,
                false,
                1,
            ],
            [
                'Controversial\\CamelCaseInstanceMethodName\\RuleDoesApplyForMethodNameWithCapital',
                false,
                false,
                1,
            ],
            [
                'Controversial\\CamelCaseInstanceMethodName\\RuleDoesApplyForMethodNameWithUnderscores',
                false,
                false,
                1,
            ],
            [
                'Controversial\\CamelCaseInstanceMethodName\\RuleDoesApplyForTestMethodWithUnderscoreWhenNotAllowed',
                false,
                false,
                1,
            ],
            [
                'Controversial\\CamelCaseInstanceMethodName\\RuleDoesApplyForValidMethodNameWithUnderscoreWhenNotAllowed',
                false,
                false,
                1,
            ],
            [
                'Controversial\\CamelCaseInstanceMethodName\\RuleDoesNotApplyForMagicMethods',
                false,
                false,
                0,
            ],
            [
                'Controversial\\CamelCaseInstanceMethodName\\RuleDoesNotApplyForStaticMethodNameWithUnderscores',
                false,
                false,
                0,
            ],
            [
                'Controversial\\CamelCaseInstanceMethodName\\RuleDoesNotApplyForTestMethodWithMultipleUnderscoresWhenAllowed',
                false,
                true,
                0,
            ],
            [
                'Controversial\\CamelCaseInstanceMethodName\\RuleDoesNotApplyForTestMethodWithUnderscoreWhenAllowed',
                false,
                true,
                0,
            ],
            [
                'Controversial\\CamelCaseInstanceMethodName\\RuleDoesNotApplyForValidMethodName',
                false,
                false,
                0,
            ],
            [
                'Controversial\\CamelCaseInstanceMethodName\\RuleDoesNotApplyForValidMethodNameWithUnderscoreWhenAllowed',
                true,
                false,
                0,
            ],
        ];
    }

    protected function initRule()
    {
        return new CamelCaseInstanceMethodName();
    }

    protected function getMethod($classPath)
    {
        $methods = $this->getClassNode($classPath)->getMethods();

        return reset($methods);
    }
}
