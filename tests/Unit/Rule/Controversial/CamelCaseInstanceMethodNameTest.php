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
     * @return (bool|int|string)[][]
     *
     * @psalm-return array{0: array{0: 'Controversial\CamelCaseInstanceMethodName\RuleAppliesToTestMethodWithTwoConsecutiveUnderscoresWhenAllowed', 1: 'false', 2: 'true', 3: 1}, 1: array{0: 'Controversial\CamelCaseInstanceMethodName\RuleAppliesToTestMethodWithUnderscoreFollowedByCapital', 1: 'false', 2: 'false', 3: 1}, 2: array{0: 'Controversial\CamelCaseInstanceMethodName\RuleDoesApplyForMethodNameWithCapital', 1: 'false', 2: 'false', 3: 1}, 3: array{0: 'Controversial\CamelCaseInstanceMethodName\RuleDoesApplyForMethodNameWithUnderscores', 1: 'false', 2: 'false', 3: 1}, 4: array{0: 'Controversial\CamelCaseInstanceMethodName\RuleDoesApplyForTestMethodWithUnderscoreWhenNotAllowed', 1: 'false', 2: 'false', 3: 1}, 5: array{0: 'Controversial\CamelCaseInstanceMethodName\RuleDoesApplyForValidMethodNameWithUnderscoreWhenNotAllowed', 1: 'false', 2: 'false', 3: 1}, 6: array{0: 'Controversial\CamelCaseInstanceMethodName\RuleDoesNotApplyForMagicMethods', 1: 'false', 2: 'false', 3: 0}, 7: array{0: 'Controversial\CamelCaseInstanceMethodName\RuleDoesNotApplyForStaticMethodNameWithUnderscores', 1: 'false', 2: 'false', 3: 0}, 8: array{0: 'Controversial\CamelCaseInstanceMethodName\RuleDoesNotApplyForTestMethodWithMultipleUnderscoresWhenAllowed', 1: 'false', 2: 'true', 3: 0}, 9: array{0: 'Controversial\CamelCaseInstanceMethodName\RuleDoesNotApplyForTestMethodWithUnderscoreWhenAllowed', 1: 'false', 2: 'true', 3: 0}, 10: array{0: 'Controversial\CamelCaseInstanceMethodName\RuleDoesNotApplyForValidMethodName', 1: 'false', 2: 'false', 3: 0}, 11: array{0: 'Controversial\CamelCaseInstanceMethodName\RuleDoesNotApplyForValidMethodNameWithUnderscoreWhenAllowed', 1: 'true', 2: 'false', 3: 0}}
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
