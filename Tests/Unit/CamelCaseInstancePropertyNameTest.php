<?php

namespace SilverStripe\PHPMD\Tests\Unit;

use SilverStripe\PHPMD\Rule\CamelCaseInstancePropertyName;
use SilverStripe\PHPMD\Tests\Unit\AbstractApplyTest;

class CamelCaseInstancePropertyNameTest extends AbstractApplyTest
{

    public function testApplyNoProperties()
    {
        $node = \Mockery::mock('PHPMD\Node\ClassNode');
        $node->shouldReceive('getProperties')->andReturn(array());

        $this->assertRule($node, 0);
    }

    public function testApplySucceedsOnValidProperty()
    {
        $validProperty = \Mockery::mock('PHPMD\Node\ASTNode');
        $validProperty->shouldReceive('isStatic')->andReturn(false);
        $validProperty->shouldReceive('getName')->andReturn('$validName');

        $node = \Mockery::mock('PHPMD\Node\ClassNode');
        $node->shouldReceive('getName')->andReturn('FooClass');
        $node->shouldReceive('getProperties')->andReturn(array(
            $validProperty
        ));

        $this->assertRule($node, 0);
    }

    public function testApplyIgnoresStaticProperty()
    {
        $validProperty = \Mockery::mock('PHPMD\Node\ASTNode');
        $validProperty->shouldReceive('isStatic')->andReturn(true);
        $validProperty->shouldReceive('getName')->andReturn('$validName');

        $node = \Mockery::mock('PHPMD\Node\ClassNode');
        $node->shouldReceive('getName')->andReturn('FooClass');
        $node->shouldReceive('getProperties')->andReturn(array(
            $validProperty
        ));

        $this->assertRule($node, 0);
    }

    public function testApplyFailsOnInvalidInstanceProperty()
    {
        $validProperty = \Mockery::mock('PHPMD\Node\ASTNode');
        $validProperty->shouldReceive('isStatic')->andReturn(false);
        $validProperty->shouldReceive('getName')->andReturn('$invalid_name');

        $node = \Mockery::mock('PHPMD\Node\ClassNode');
        $node->shouldReceive('getName')->andReturn('FooClass');
        $node->shouldReceive('getProperties')->andReturn(array(
            $validProperty
        ));

        $this->assertRule($node, 1);
    }

    /**
     * @return CamelCaseInstancePropertyName
     */
    protected function getRule()
    {
        return new CamelCaseInstancePropertyName();
    }
}
