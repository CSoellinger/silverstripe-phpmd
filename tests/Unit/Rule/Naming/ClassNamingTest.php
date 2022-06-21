<?php

namespace CSoellinger\SilverStripe\PHPMD\Tests\Unit\Rule\Naming;

use CSoellinger\SilverStripe\PHPMD\Rule\Naming\ClassNaming;
use CSoellinger\SilverStripe\PHPMD\Tests\Unit\TestCase;

/**
 * tbd.
 *
 * @internal
 * @covers \CSoellinger\SilverStripe\PHPMD\Rule\Naming\ClassNaming
 */
class ClassNamingTest extends TestCase
{
    /**
     * @dataProvider getFixtureClassPaths
     */
    public function testRuleClassNaming(string $classPath, string $className, int $violationNumber): void
    {
        $this->getRule()->setReport($this->getReport($violationNumber));
        $this->getRule()->apply($this->getClassNode($classPath, $className));
    }

    /**
     * @return array<array{0:string,1:string,2:int}>
     */
    public function getFixtureClassPaths()
    {
        return [
            ['Naming\\ClassNaming\\RuleDoesApplyWithWrongFileName', 'WrongClassName', 1], // error
        ];
    }

    protected function initRule(): ClassNaming
    {
        return new ClassNaming();
    }
}
