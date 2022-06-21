<?php

namespace CSoellinger\SilverStripe\PHPMD\Tests\Unit\Rule\Controversial;

use CSoellinger\SilverStripe\PHPMD\Rule\Controversial\CamelCaseInstanceMethodName;
use CSoellinger\SilverStripe\PHPMD\Tests\Unit\TestCase;
use PHPMD\AbstractNode;

/**
 * tbd.
 *
 * @internal
 * @covers \CSoellinger\SilverStripe\PHPMD\Rule\Controversial\CamelCaseInstanceMethodName
 */
class CamelCaseInstanceMethodNameTest extends TestCase
{
    /**
     * @dataProvider getFixtureClassPaths
     */
    public function testRuleCamelCaseInstanceMethodName(
        string $classPath,
        string $allowUnderscore,
        string $allowUnderscoreTest,
        int $violationNumber
    ): void {
        $this->getRule()->setReport($this->getReport($violationNumber));
        $this->getRule()->addProperty('allow-underscore', $allowUnderscore);
        $this->getRule()->addProperty('allow-underscore-test', $allowUnderscoreTest);
        $this->getRule()->apply($this->getMethod($classPath));
    }

    /**
     * @return array<array{0:string,1:string,2:string,3:int}>
     */
    public function getFixtureClassPaths(): array
    {
        return [
            [
                'Controversial\\CamelCaseInstanceMethodName\\RuleAppliesToTestMethodWithTwoConsecutiveUnderscoresWhenAllowed',
                'false',
                'true',
                1,
            ],
            [
                'Controversial\\CamelCaseInstanceMethodName\\RuleAppliesToTestMethodWithUnderscoreFollowedByCapital',
                'false',
                'false',
                1,
            ],
            [
                'Controversial\\CamelCaseInstanceMethodName\\RuleDoesApplyForMethodNameWithCapital',
                'false',
                'false',
                1,
            ],
            [
                'Controversial\\CamelCaseInstanceMethodName\\RuleDoesApplyForMethodNameWithUnderscores',
                'false',
                'false',
                1,
            ],
            [
                'Controversial\\CamelCaseInstanceMethodName\\RuleDoesApplyForTestMethodWithUnderscoreWhenNotAllowed',
                'false',
                'false',
                1,
            ],
            [
                'Controversial\\CamelCaseInstanceMethodName\\RuleDoesApplyForValidMethodNameWithUnderscoreWhenNotAllowed',
                'false',
                'false',
                1,
            ],
            [
                'Controversial\\CamelCaseInstanceMethodName\\RuleDoesNotApplyForMagicMethods',
                'false',
                'false',
                0,
            ],
            [
                'Controversial\\CamelCaseInstanceMethodName\\RuleDoesNotApplyForStaticMethodNameWithUnderscores',
                'false',
                'false',
                0,
            ],
            [
                'Controversial\\CamelCaseInstanceMethodName\\RuleDoesNotApplyForTestMethodWithMultipleUnderscoresWhenAllowed',
                'false',
                'true',
                0,
            ],
            [
                'Controversial\\CamelCaseInstanceMethodName\\RuleDoesNotApplyForTestMethodWithUnderscoreWhenAllowed',
                'false',
                'true',
                0,
            ],
            [
                'Controversial\\CamelCaseInstanceMethodName\\RuleDoesNotApplyForValidMethodName',
                'false',
                'false',
                0,
            ],
            [
                'Controversial\\CamelCaseInstanceMethodName\\RuleDoesNotApplyForValidMethodNameWithUnderscoreWhenAllowed',
                'true',
                'false',
                0,
            ],
        ];
    }

    protected function initRule(): CamelCaseInstanceMethodName
    {
        return new CamelCaseInstanceMethodName();
    }

    protected function getMethod(string $classPath): AbstractNode
    {
        $methods = $this->getClassNode($classPath)->getMethods();

        return reset($methods);
    }
}
