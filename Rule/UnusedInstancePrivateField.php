<?php

namespace SilverStripe\PHPMD\Rule;

use PHPMD\AbstractNode;
use PHPMD\AbstractRule;
use PHPMD\Rule\ClassAware;
use PHPMD\Node\ClassNode;
use PHPMD\Node\ASTNode;

/**
 * Check for unused private instance properties, but ignore static ones
 * since these are created by design in SilverStripe as configuration markers.
 * Copying UnusedPrivateField class implemenation
 * since (ironically) the $fields property is set to private.
 */
class UnusedInstancePrivateField extends AbstractRule implements ClassAware
{
    /**
     * Collected private fields/variable declarators in the currently processed
     * class.
     *
     * @var \PHPMD\Node\ASTNode[]
     */
    private $fields = array();

    /**
     * This method checks that all private class properties are at least accessed
     * by one method.
     *
     * @param \PHPMD\AbstractNode $node
     * @return void
     */
    public function apply(AbstractNode $node)
    {
        foreach ($this->collectUnusedPrivateFields($node) as $field) {
            $this->addViolation($field, array($field->getImage()));
        }
    }

    /**
     * This method collects all private fields that aren't used by any class
     * method.
     *
     * @param \PHPMD\Node\ClassNode $class
     * @return \PHPMD\AbstractNode[]
     */
    private function collectUnusedPrivateFields(ClassNode $class)
    {
        $this->fields = array();

        $this->collectPrivateFields($class);
        $this->removeUsedFields($class);

        return $this->fields;
    }

    /**
     * This method collects all private fields in the given class and stores
     * them in the <b>$_fields</b> property.
     *
     * @param \PHPMD\Node\ClassNode $class
     * @return void
     */
    private function collectPrivateFields(ClassNode $class)
    {
        foreach ($class->findChildrenOfType('FieldDeclaration') as $declaration) {
            // Custom for SilverStripe: Exclude private statics
            if ($declaration->isPrivate() && !$declaration->isStatic()) {
                $this->collectPrivateField($declaration);
            }
        }
    }

    /**
     * This method extracts all variable declarators from the given field
     * declaration and stores them in the <b>$_fields</b> property.
     *
     * @param \PHPMD\Node\ASTNode $declaration
     * @return void
     */
    private function collectPrivateField(ASTNode $declaration)
    {
        $fields = $declaration->findChildrenOfType('VariableDeclarator');
        foreach ($fields as $field) {
            $this->fields[$field->getImage()] = $field;
        }
    }

    /**
     * This method extracts all property postfix nodes from the given class and
     * removes all fields from the <b>$_fields</b> property that are accessed by
     * one of the postfix nodes.
     *
     * @param \PHPMD\Node\ClassNode $class
     * @return void
     */
    private function removeUsedFields(ClassNode $class)
    {
        foreach ($class->findChildrenOfType('PropertyPostfix') as $postfix) {
            if ($this->isInScopeOfClass($class, $postfix)) {
                $this->removeUsedField($postfix);
            }
        }
    }

    /**
     * This method removes the field from the <b>$_fields</b> property that is
     * accessed through the given property postfix node.
     *
     * @param \PHPMD\Node\ASTNode $postfix
     * @return void
     */
    private function removeUsedField(ASTNode $postfix)
    {
        if ($postfix->getParent()->isStatic()) {
            $image = '';
            $child = $postfix->getFirstChildOfType('Variable');
        } else {
            $image = '$';
            $child = $postfix->getFirstChildOfType('Identifier');
        }


        if ($this->isValidPropertyNode($child)) {
            unset($this->fields[$image . $child->getImage()]);
        }
    }

    /**
     * Checks if the given node is a valid property node.
     *
     * @param \PHPMD\Node\ASTNode $node
     * @return boolean
     * @since 0.2.6
     */
    protected function isValidPropertyNode(ASTNode $node = null)
    {
        if ($node === null) {
            return false;
        }
        
        $parent = $node->getParent();
        while (!$parent->isInstanceOf('PropertyPostfix')) {
            if ($parent->isInstanceOf('CompoundVariable')) {
                return false;
            }
            $parent = $parent->getParent();
            if (is_null($parent)) {
                   return false;
            }
        }
        return true;
    }

    /**
     * This method checks that the given property postfix is accessed on an
     * instance or static reference to the given class.
     *
     * @param \PHPMD\Node\ClassNode $class
     * @param \PHPMD\Node\ASTNode $postfix
     * @return boolean
     */
    protected function isInScopeOfClass(ClassNode $class, ASTNode $postfix)
    {
        $owner = $postfix->getParent()->getChild(0);
        if ($owner->isInstanceOf('PropertyPostfix')) {
            $owner = $owner->getParent()->getParent()->getChild(0);
        }
        return (
            $owner->isInstanceOf('SelfReference') ||
            $owner->isInstanceOf('StaticReference') ||
            strcasecmp($owner->getImage(), '$this') === 0 ||
            strcasecmp($owner->getImage(), $class->getImage()) === 0
        );
    }
}
