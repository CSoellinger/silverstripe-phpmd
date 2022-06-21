<?php

namespace CSoellinger\SilverStripe\PHPMD\Rule;

use PHPMD\Node\AbstractNode;
use PHPMD\Node\ASTNode;
use PHPMD\Node\ClassNode;
use PHPMD\Rule\ClassAware;
use PHPMD\Rule\UnusedPrivateField;

/**
 * Check for unused private instance properties, but ignore static ones
 * since these are created by design in SilverStripe as configuration markers.
 *
 * {@inheritDoc}
 */
class UnusedInstancePrivateField extends UnusedPrivateField implements ClassAware
{
    /**
     * This class will be overwritten cause we are ignoring private static
     * properties for SilverStripe design pattern.
     *
     * {@inheritDoc}
     */
    protected function collectUnusedPrivateFields(ClassNode $class)
    {
        /** @var array<array-key,ASTNode> */
        $this->fields = parent::collectUnusedPrivateFields($class);

        $this->removePrivateStaticFields($class);

        return $this->fields;
    }

    protected function removePrivateStaticFields(ClassNode $class): void
    {
        foreach ($class->findChildrenOfType('FieldDeclaration') as $declaration) {
            if ($declaration->isPrivate() && $declaration->isStatic()) {
                $this->removePrivateStaticField($declaration);
            }
        }
    }

    protected function removePrivateStaticField(ASTNode $declaration): void
    {
        $fields = $declaration->findChildrenOfType('VariableDeclarator');

        foreach ($fields as $field) {
            unset($this->fields[$field->getImage()]);
        }
    }
}
