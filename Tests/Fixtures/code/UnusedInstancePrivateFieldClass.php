<?php
class UnusedInstancePrivateFieldClass {

	private static $unused_static_field = true;

	private $unusedInstanceField = true;

	private $usedInstanceField = true;

	public function getUsedInstanceField() {
		return $this->usedInstanceField;
	}

}