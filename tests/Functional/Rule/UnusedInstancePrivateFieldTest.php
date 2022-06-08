<?php

// namespace CSoellinger\SilverStripe\PHPMD\Tests\Functional\Rule;

// use CSoellinger\SilverStripe\PHPMD\Tests\Functional\TestCase;

// /**
//  * Test case for the unused private field rule.
//  *
//  * @internal
//  * @coversNothing
//  */
// class UnusedInstancePrivateFieldTest extends TestCase
// {
//     public const VIOLATION_OUTPUT = 'UnusedInstancePrivateField  Avoid unused private instance fields such as \'$foo\'.';

//     /**
//      * @dataProvider getFixtureClassPaths
//      */
//     public function testRuleUnusedPrivateInstanceField(string $file, bool $violation)
//     {
//         $this->testFile($file, $violation);
//     }

//     public function getFixtureClassPaths()
//     {
//         return [
//             ['UnusedInstancePrivateField/RuleAppliesToUnusedPrivateField', true],
//             ['UnusedInstancePrivateField/RuleAppliesWhenFieldWithSameNameIsAccessedOnDifferentObject', true],
//             ['UnusedInstancePrivateField/RuleAppliesWhenStaticFieldWithSameNameIsAccessedOnDifferentClass', true],
//             ['UnusedInstancePrivateField/RuleAppliesWhenStaticFieldWithSameNameIsAccessedOnParent', true],
//             ['UnusedInstancePrivateField/RuleDoesNotApplyToUnusedPrivateStaticField', false],
//             ['UnusedInstancePrivateField/RuleDoesNotApplyWhenLocalVariableIsUsedInStaticMemberPrefix', false],
//             ['UnusedInstancePrivateField/RuleDoesNotApplyToClassNameAccessedPrivateField', false],
//             ['UnusedInstancePrivateField/RuleDoesNotApplyToFieldWithMethodsThatReturnArray', false],
//             ['UnusedInstancePrivateField/RuleDoesNotApplyToPrivateArrayFieldAccess', false],
//             ['UnusedInstancePrivateField/RuleDoesNotApplyToPrivateFieldInChainedMethodCall', false],
//             ['UnusedInstancePrivateField/RuleDoesNotApplyToPrivateStringIndexFieldAccess', false],
//             ['UnusedInstancePrivateField/RuleDoesNotApplyToSelfAccessedPrivateField', false],
//             ['UnusedInstancePrivateField/RuleDoesNotApplyToStaticAccessedPrivateField', false],
//             ['UnusedInstancePrivateField/RuleDoesNotApplyToThisAccessedPrivateField', false],
//             ['UnusedInstancePrivateField/RuleDoesNotApplyToUnusedProtectedField', false],
//             ['UnusedInstancePrivateField/RuleDoesNotApplyToUnusedPublicField', false],
//             ['UnusedInstancePrivateField/RuleDoesNotResultInFatalErrorByCallingNonObject', true],
//         ];
//     }

//     public function getViolationOutput(): string
//     {
//         return self::VIOLATION_OUTPUT;
//     }
// }
