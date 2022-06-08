<?php

namespace CSoellinger\SilverStripe\PHPMD\Tests\Unit\Rule\Naming;

use CSoellinger\SilverStripe\PHPMD\Rule\Controversial\CamelCaseInstancePropertyName;
use CSoellinger\SilverStripe\PHPMD\Rule\Naming\ClassNaming;
use CSoellinger\SilverStripe\PHPMD\Tests\Unit\TestCase;

// use CSoellinger\SilverStripe\PHPMD\Rule\Naming\ClassNaming;
// use Mockery;
// use Mockery\MockInterface;
// use PHPMD\Node\ClassNode;
// use PHPMD\Node\MethodNode;
// use SilverStripe\PHPMD\Tests\Unit\AbstractApplyTest;

/**
 * tbd.
 *
 * @internal
 * @coversNothing
 */
class ClassNamingTest extends TestCase
{
    /**
     * @dataProvider getFixtureClassPaths
     */
    public function testRuleClassNaming(string $classPath, string $className, int $violationNumber)
    {
        $this->getRule()->setReport($this->getReport($violationNumber));
        $this->getRule()->apply($this->getClassNode($classPath, $className));
    }

    public function getFixtureClassPaths()
    {
        return [
            ['Naming\\ClassNaming\\RuleDoesApplyWithWrongFileName', 'WrongClassName', 1], // error
        ];
    }

    protected function initRule()
    {
        return new ClassNaming();
    }
}
