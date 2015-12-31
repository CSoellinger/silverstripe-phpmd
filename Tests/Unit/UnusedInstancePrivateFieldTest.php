<?php

namespace SilverStripe\PHPMD\Tests\Unit;

use SilverStripe\PHPMD\Rule\UnusedInstancePrivateField;
use SilverStripe\PHPMD\Tests\Unit\AbstractApplyTest;

class UnusedInstancePrivateFieldTest extends AbstractApplyTest
{

    public function testApplyPrivateStatic()
    {
        $validStaticField = \Mockery::mock('PHPMD\Node\ASTNode')
            ->shouldReceive('getImage')->andReturn('unused_static_field')->mock();

        $validStaticDeclaration = \Mockery::mock('PHPMD\Node\ASTNode')
            ->shouldReceive('isPrivate')->andReturn(true)->mock()
            ->shouldReceive('isStatic')->andReturn(true)->mock()
            ->shouldReceive('findChildrenOfType')->with('VariableDeclarator')->andReturn(array(
                $validStaticField
            ))->mock();

        $invalidInstanceField = \Mockery::mock('PHPMD\Node\ASTNode')
            ->shouldReceive('getImage')->andReturn('unusedInstanceField')->mock();

        $invalidInstanceDeclaration = \Mockery::mock('PHPMD\Node\ASTNode')
            ->shouldReceive('isPrivate')->andReturn(true)->mock()
            ->shouldReceive('isStatic')->andReturn(false)->mock()
            ->shouldReceive('findChildrenOfType')->with('VariableDeclarator')->andReturn(array(
                $invalidInstanceField
            ))->mock();

        $node = \Mockery::mock('PHPMD\Node\ClassNode')
            ->shouldReceive('findChildrenOfType')->with('FieldDeclaration')->andReturn(array(
                $invalidInstanceDeclaration,
                $validStaticDeclaration
            ))->mock()
            ->shouldReceive('getName')->andReturn('FooClass')->mock()
            ->shouldReceive('findChildrenOfType')->with('PropertyPostfix')->andReturn(array())
            ->mock();

        $this->assertRule($node, 1);
    }

    /**
     * @return UnusedInstancePrivateField
     */
    protected function getRule()
    {
        return new UnusedInstancePrivateField();
    }
}
