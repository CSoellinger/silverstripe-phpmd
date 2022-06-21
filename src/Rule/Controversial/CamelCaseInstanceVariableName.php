<?php

namespace CSoellinger\SilverStripe\PHPMD\Rule\Controversial;

use PDepend\Source\AST\AbstractASTArtifact;
use PDepend\Source\AST\AbstractASTNode;
use PDepend\Source\AST\ASTArtifact;
use PDepend\Source\AST\ASTMemberPrimaryPrefix;
use PDepend\Source\AST\ASTNode as ASTASTNode;
use PDepend\Source\AST\ASTVariable;
use PHPMD\AbstractNode;
use PHPMD\Node\ASTNode;
use PHPMD\Rule\Controversial\CamelCaseVariableName;
use PHPMD\Rule\FunctionAware;
use PHPMD\Rule\MethodAware;

/**
 * Check if variable is not camel case. Ignore static calls like Foo::$variable_name
 * cause of SilverStripe design.
 *
 * {@inheritDoc}
 */
class CamelCaseInstanceVariableName extends CamelCaseVariableName implements MethodAware, FunctionAware
{
    /**
     * Ignore static variable calls cause of SilverStripe design.
     *
     * {@inheritDoc}
     */
    public function apply(AbstractNode $node)
    {
        /** @var ASTNode $variable */
        foreach ($node->findChildrenOfTypeVariable() as $variable) {
            if (!$this->isValid($variable) && !$this->isStaticCall($variable)) {
                $this->addViolation(
                    $node,
                    [
                        $variable->getImage(),
                    ]
                );
            }
        }
    }

    /**
     * tbd.
     */
    protected function isStaticCall(AbstractNode $variable): bool
    {
        /** @var ASTVariable $variableNode */
        $variableNode = $variable->getNode();
        $memberPrimaryPrefix = $this->getParentMemberPrimaryPrefix($variableNode);

        if ($memberPrimaryPrefix && $memberPrimaryPrefix->isStatic()) {
            return true;
        }

        return false;
    }

    /**
     * tbd.
     *
     * @return ?ASTMemberPrimaryPrefix
     */
    protected function getParentMemberPrimaryPrefix(AbstractASTNode $variableNode)
    {
        if ($variableNode instanceof ASTMemberPrimaryPrefix) {
            return $variableNode;
        }

        /** @var ?AbstractASTNode $parent */
        $parent = $variableNode->getParent();

        if ($parent) {
            return $this->getParentMemberPrimaryPrefix($parent);
        }

        return null;
    }
}
