<?php

namespace CSoellinger\SilverStripe\PHPMD\Tests\Unit\Rule;

use CSoellinger\SilverStripe\PHPMD\Rule\UnusedInstancePrivateField;
use CSoellinger\SilverStripe\PHPMD\Tests\Unit\TestCase;

/**
 * Test case for the unused private field rule.
 */
class UnusedInstancePrivateFieldTest extends TestCase
{
    /**
     * @dataProvider getFixtureClassPaths
     */
    public function testRuleUnusedPrivateInstanceField($classPath, $violationNumber)
    {
        $this->getRule()->setReport($this->getReport($violationNumber));
        $this->getRule()->apply($this->getClassNode($classPath));
    }

    public function getFixtureClassPaths()
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

    protected function initRule()
    {
        return new UnusedInstancePrivateField();
    }
}
