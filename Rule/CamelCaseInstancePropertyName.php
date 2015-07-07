<?php

namespace SilverStripe\PHPMD\Rule;

use PHPMD\AbstractNode;
use PHPMD\AbstractRule;
use PHPMD\Rule\ClassAware;

/**
 * This rule class detects instance properties not named in camelCase.
 */
class CamelCaseInstancePropertyName extends AbstractRule implements ClassAware
{
	public function apply(AbstractNode $node) {
		foreach ($node->getProperties() as $property) {
			if (!$property->isStatic() && !preg_match('/^\$[a-zA-Z][a-zA-Z0-9]*$/', $property->getName())) {
				$this->addViolation(
					$node,
					array(
						$property->getName(),
					)
				);
			}
		}
	}
}
