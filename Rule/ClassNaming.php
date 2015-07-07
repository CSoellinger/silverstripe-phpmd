<?php

namespace SilverStripe\PHPMD\Rule;

use PHPMD\AbstractNode;
use PHPMD\AbstractRule;
use PHPMD\Rule\ClassAware;

class ClassNaming extends AbstractRule implements ClassAware
{
	public function apply(AbstractNode $node) {
		$filename = $node->getFileName();
		$base = basename($filename, '.php');

		if (!preg_match('/^(SS_)?'.$base.'(_[A-Z][a-zA-Z0-9]+)?$/', $node->getName())) {
	        $this->addViolation(
		        $node,
		        array(
			        $node->getName(),
			        basename($filename)
		        )
	        );
        }
    }
}

