<?php
namespace TYPO3\FLOW3\Test\Session\Domain\Model;

/*                                                                        *
 * This script belongs to the FLOW3 package "TYPO3.FLOW3.Test.Session".   *
 *                                                                        *
 *                                                                        */

/**
 * A Item
 *
 * @scope prototype
 * @entity
 */
class Item {

	/**
	 * The name
	 * @var string
	 */
	protected $name;


	/**
	 * Get the Item's name
	 *
	 * @return string The Item's name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets this Item's name
	 *
	 * @param string $name The Item's name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

}
?>