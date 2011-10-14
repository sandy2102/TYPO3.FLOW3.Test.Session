<?php
namespace TYPO3\FLOW3\Test\Session\Domain\Model;

/*                                                                        *
 * This script belongs to the FLOW3 package "TYPO3.FLOW3.Test.Session".   *
 *                                                                        *
 *                                                                        */

use Doctrine\ORM\Mapping as ORM;
use TYPO3\FLOW3\Annotations as FLOW3;

/**
 * A Shopping basket
 *
 * @FLOW3\Scope("session")
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
	 * @FLOW3\Session(autoStart=true)
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @param Item $item
	 * @FLOW3\Session(autoStart=true)
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