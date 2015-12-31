<?php

namespace SilverStripe\PHPMD\Tests\Unit;

use SilverStripe\PHPMD\Rule\ClassNaming;
use SilverStripe\PHPMD\Tests\Unit\AbstractApplyTest;

class ClassNamingTest extends AbstractApplyTest
{

    public function testApplyNoClassNode()
    {
        $node = \Mockery::mock('PHPMD\Node\MethodNode');
        $node->shouldReceive('getFileName')->andReturn('FooClass.php');
        $node->shouldReceive('getName')->andReturn('FooClass');

        $this->assertRule($node, 0);
    }

    public function testApplyClassNameEqualsFilename()
    {
        $node = \Mockery::mock('PHPMD\Node\ClassNode');
        $node->shouldReceive('getFileName')->andReturn('FooClass.php');
        $node->shouldReceive('getName')->andReturn('FooClass');

        $this->assertRule($node, 0);
    }

    public function testApplyClassNameWithPrefix()
    {
        $node = \Mockery::mock('PHPMD\Node\ClassNode');
        $node->shouldReceive('getFileName')->andReturn('FooClass.php');
        $node->shouldReceive('getName')->andReturn('SS_FooClass');

        $this->assertRule($node, 0);
    }

    public function testApplyClassNameDifferentFromFilename()
    {
        $node = \Mockery::mock('PHPMD\Node\ClassNode');
        $node->shouldReceive('getFileName')->andReturn('ClassNamingFail.php');
        $node->shouldReceive('getName')->andReturn('FooClass');

        $this->assertRule($node, 1);
    }

    /**
     * @return ClassNaming
     */
    protected function getRule()
    {
        return new ClassNaming();
    }
}
