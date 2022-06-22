<?php

namespace CSoellinger\SilverStripe\PHPMD\Rule\Controversial;

use PDepend\Source\AST\ASTClass;
use PDepend\Source\AST\ASTProperty;
use PHPMD\AbstractNode;
use PHPMD\Node\ClassNode;
use PHPMD\Rule\ClassAware;
use PHPMD\Rule\Controversial\CamelCasePropertyName;

/**
 * Check for camel case instance properties, but ignore static ones
 * since these are created by design in SilverStripe as configuration markers.
 *
 * {@inheritDoc}
 */
class CamelCaseInstancePropertyName extends CamelCasePropertyName implements ClassAware
{
    /**
     * This class will be overwritten cause we are ignoring static properties
     * for SilverStripe design pattern.
     *
     * {@inheritDoc}
     */
    public function apply(AbstractNode $node)
    {
        /** @var ASTClass $classNode */
        $classNode = $node;
        $allowUnderscore = $this->getBooleanProperty('allow-underscore');

        $pattern = '/^\$[a-z][a-zA-Z0-9]*$/';
        if ($allowUnderscore === true) {
            $pattern = '/^\$[_]?[a-z][a-zA-Z0-9]*$/';
        }
// var_dump(gettype($classNode), get_class($classNode));
        /** @var ASTProperty $property */
        foreach ($classNode->getProperties() as $property) {
            $propertyName = $property->getName();

            if (!$property->isStatic() && (bool) preg_match($pattern, $propertyName) === false) {
                $this->addViolation(
                    $node,
                    [
                        $propertyName,
                    ]
                );
            }
        }
    }
}
