<?php

namespace CSoellinger\SilverStripe\PHPMD\Rule\Controversial;

use PDepend\Source\AST\ASTMethod;
use PHPMD\AbstractNode;
use PHPMD\Rule\ClassAware;
use PHPMD\Rule\Controversial\CamelCaseMethodName;

/**
 * Check for camel case methods, but ignore static ones
 * since these are created by design in SilverStripe as configuration markers.
 *
 * {@inheritDoc}
 */
class CamelCaseInstanceMethodName extends CamelCaseMethodName implements ClassAware
{
    /**
     * This method checks if a method is not named in camelCase
     * and emits a rule violation but ignores statics.
     *
     * {@inheritDoc}
     */
    public function apply(AbstractNode $node)
    {
        $methodName = $node->getName();

        /** @var ASTMethod $methodNode */
        $methodNode = $node->getNode();

        if (
            $node->getType() === 'method'
            && !in_array($methodName, $this->ignoredMethods)
            && !$this->isValid($methodName)
            && !$methodNode->isStatic()
        ) {
            $this->addViolation(
                $node,
                [
                    $methodName,
                ]
            );
        }
    }
}
