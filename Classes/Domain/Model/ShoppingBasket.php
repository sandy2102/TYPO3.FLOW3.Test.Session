<?php
namespace TYPO3\FLOW3\Test\Session\Domain\Model;

/*                                                                        *
 * This script belongs to the FLOW3 package "TYPO3.FLOW3.Test.Session".   *
 *                                                                        *
 *                                                                        */

/**
 * A Shopping basket
 *
 * @scope session
 */
class ShoppingBasket {

	/**
	 * The name
	 * @var string
	 */
	protected $name = '';

	/**
	 * @var array
	 */
	protected $items = array();


	/**
	 * Get the Shopping basket's name
	 *
	 * @return string The Shopping basket's name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets this Shopping basket's name
	 *
	 * @param string $name The Shopping basket's name
	 * @return void
	 * @session autoStart=true
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @param Item $item
	 * @session autoStart=true
	 */
	public function addItem(Item $item) {
		$this->items[] = $item;
	}

	/**
	 * Returns items
	 *
	 * @return array
	 */
	public function getItems() {
		return $this->items;
	}
}
?>