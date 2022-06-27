<?php

namespace CSoellinger\SilverStripe\PHPMD\Rule;

use PDepend\Source\AST\ASTFieldDeclaration;
use PDepend\Source\AST\ASTNode as PdASTNode;
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
        /** @var ASTNode[] $fields */
        $fields = parent::collectUnusedPrivateFields($class);
        $this->fields = $fields;

        $this->removePrivateStaticFields($class);

        return $this->fields;
    }

    protected function removePrivateStaticFields(ClassNode $class): void
    {
        /** @var ASTFieldDeclaration $declaration */
        foreach ($class->findChildrenOfType('FieldDeclaration') as $declaration) {
            if ($declaration->isPrivate() && $declaration->isStatic()) {
                $this->removePrivateStaticField($declaration);
            }
        }
    }

    /**
     * Undocumented function.
     *
     * @param ASTFieldDeclaration|ASTNode $declaration
     */
    protected function removePrivateStaticField($declaration): void
    {
        /** @psalm-var class-string<PdASTNode> $type */
        $type = 'VariableDeclarator';
        $fields = $declaration->findChildrenOfType($type);

        foreach ($fields as $field) {
            unset($this->fields[$field->getImage()]);
        }
    }
}
