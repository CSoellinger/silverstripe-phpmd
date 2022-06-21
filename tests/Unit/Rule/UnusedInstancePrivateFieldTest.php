<?php

namespace CSoellinger\SilverStripe\PHPMD\Tests\Unit\Rule;

use CSoellinger\SilverStripe\PHPMD\Rule\UnusedInstancePrivateField;
use CSoellinger\SilverStripe\PHPMD\Tests\Unit\TestCase;

/**
 * Test case for the unused private field rule.
 *
 * @covers \CSoellinger\SilverStripe\PHPMD\Rule\UnusedInstancePrivateField
 *
 * @internal
 */
class UnusedInstancePrivateFieldTest extends TestCase
{
    /**
     * @dataProvider getFixtureClassPaths
     */
    public function testRuleUnusedPrivateInstanceField(string $classPath, int $violationNumber): void
    {
        $this->getRule()->setReport($this->getReport($violationNumber));
        $this->getRule()->apply($this->getClassNode($classPath));
    }

    /**
     * @return (int|string)[][]
     *
     * @psalm-return array{0: array{0: 'UnusedInstancePrivateField\RuleAppliesToUnusedPrivateField', 1: 1}, 1: array{0: 'UnusedInstancePrivateField\RuleAppliesWhenFieldWithSameNameIsAccessedOnDifferentObject', 1: 1}, 2: array{0: 'UnusedInstancePrivateField\RuleAppliesWhenStaticFieldWithSameNameIsAccessedOnDifferentClass', 1: 1}, 3: array{0: 'UnusedInstancePrivateField\RuleAppliesWhenStaticFieldWithSameNameIsAccessedOnParent', 1: 1}, 4: array{0: 'UnusedInstancePrivateField\RuleDoesNotApplyToUnusedPrivateStaticField', 1: 0}, 5: array{0: 'UnusedInstancePrivateField\RuleDoesNotApplyWhenLocalVariableIsUsedInStaticMemberPrefix', 1: 0}, 6: array{0: 'UnusedInstancePrivateField\RuleDoesNotApplyToClassNameAccessedPrivateField', 1: 0}, 7: array{0: 'UnusedInstancePrivateField\RuleDoesNotApplyToFieldWithMethodsThatReturnArray', 1: 0}, 8: array{0: 'UnusedInstancePrivateField\RuleDoesNotApplyToPrivateArrayFieldAccess', 1: 0}, 9: array{0: 'UnusedInstancePrivateField\RuleDoesNotApplyToPrivateFieldInChainedMethodCall', 1: 0}, 10: array{0: 'UnusedInstancePrivateField\RuleDoesNotApplyToPrivateStringIndexFieldAccess', 1: 0}, 11: array{0: 'UnusedInstancePrivateField\RuleDoesNotApplyToSelfAccessedPrivateField', 1: 0}, 12: array{0: 'UnusedInstancePrivateField\RuleDoesNotApplyToStaticAccessedPrivateField', 1: 0}, 13: array{0: 'UnusedInstancePrivateField\RuleDoesNotApplyToThisAccessedPrivateField', 1: 0}, 14: array{0: 'UnusedInstancePrivateField\RuleDoesNotApplyToUnusedProtectedField', 1: 0}, 15: array{0: 'UnusedInstancePrivateField\RuleDoesNotApplyToUnusedPublicField', 1: 0}, 16: array{0: 'UnusedInstancePrivateField\RuleDoesNotResultInFatalErrorByCallingNonObject', 1: 1}}
     */
    public function getFixtureClassPaths(): array
    {
        return [
            ['UnusedInstancePrivateField\\RuleAppliesToUnusedPrivateField', 1],
            ['UnusedInstancePrivateField\\RuleAppliesWhenFieldWithSameNameIsAccessedOnDifferentObject', 1],
            ['UnusedInstancePrivateField\\RuleAppliesWhenStaticFieldWithSameNameIsAccessedOnDifferentClass', 1],
            ['UnusedInstancePrivateField\\RuleAppliesWhenStaticFieldWithSameNameIsAccessedOnParent', 1],
            ['UnusedInstancePrivateField\\RuleDoesNotApplyToUnusedPrivateStaticField', 0],
            ['UnusedInstancePrivateField\\RuleDoesNotApplyWhenLocalVariableIsUsedInStaticMemberPrefix', 0],
            ['UnusedInstancePrivateField\\RuleDoesNotApplyToClassNameAccessedPrivateField', 0],
            ['UnusedInstancePrivateField\\RuleDoesNotApplyToFieldWithMethodsThatReturnArray', 0],
            ['UnusedInstancePrivateField\\RuleDoesNotApplyToPrivateArrayFieldAccess', 0],
            ['UnusedInstancePrivateField\\RuleDoesNotApplyToPrivateFieldInChainedMethodCall', 0],
            ['UnusedInstancePrivateField\\RuleDoesNotApplyToPrivateStringIndexFieldAccess', 0],
            ['UnusedInstancePrivateField\\RuleDoesNotApplyToSelfAccessedPrivateField', 0],
            ['UnusedInstancePrivateField\\RuleDoesNotApplyToStaticAccessedPrivateField', 0],
            ['UnusedInstancePrivateField\\RuleDoesNotApplyToThisAccessedPrivateField', 0],
            ['UnusedInstancePrivateField\\RuleDoesNotApplyToUnusedProtectedField', 0],
            ['UnusedInstancePrivateField\\RuleDoesNotApplyToUnusedPublicField', 0],
            ['UnusedInstancePrivateField\\RuleDoesNotResultInFatalErrorByCallingNonObject', 1],
        ];
    }

    protected function initRule(): UnusedInstancePrivateField
    {
        return new UnusedInstancePrivateField();
    }
}
