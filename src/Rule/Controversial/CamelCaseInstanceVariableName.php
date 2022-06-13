<?php

namespace CSoellinger\SilverStripe\PHPMD\Rule\Controversial;

use PDepend\Source\AST\AbstractASTArtifact;
use PDepend\Source\AST\ASTMemberPrimaryPrefix;
use PDepend\Source\AST\ASTVariable;
use PHPMD\AbstractNode;
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
     *
     * @param mixed $variable
     */
    protected function isStaticCall($variable): bool
    {
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
     * @param mixed $variableNode
     *
     * @return ?ASTMemberPrimaryPrefix
     */
    protected function getParentMemberPrimaryPrefix($variableNode)
    {
        if ($variableNode instanceof ASTMemberPrimaryPrefix) {
            return $variableNode;
        }

        if ($variableNode->getParent()) {
            return $this->getParentMemberPrimaryPrefix($variableNode->getParent());
        }

        return null;
    }
}
