<?php
namespace TYPO3\FLOW3\Test\Session\Controller;

/*                                                                        *
 * This script belongs to the FLOW3 package "TYPO3.FLOW3.Test.Session".   *
 *                                                                        *
 *                                                                        */

use \TYPO3\FLOW3\MVC\Controller\ActionController;
use \TYPO3\FLOW3\Test\Session\Domain\Model\ShoppingBasket;
use \TYPO3\FLOW3\Test\Session\Domain\Model\Item;

/**
 * ShoppingBasket controller for the TYPO3.FLOW3.Test.Session package
 *
 * @scope singleton
 */
class ShoppingBasketController extends ActionController {

	/**
	 * @inject
	 * @var \TYPO3\FLOW3\Security\Context
	 */
	protected $securityContext;

	/**
	 * @inject
	 * @var \TYPO3\FLOW3\Session\SessionInterface
	 */
	protected $session;

	/**
	 * @inject
	 * @var \TYPO3\FLOW3\Test\Session\Domain\Model\ShoppingBasket
	 */
	protected $shoppingBasket;

	/**
	 * @inject
	 * @var \TYPO3\FLOW3\Test\Session\Domain\Repository\ItemRepository
	 */
	protected $itemRepository;

	/**
	 * @inject
	 * @var \TYPO3\FLOW3\Security\AccountRepository
	 */
	protected $accountRepository;

	/**
	 * @inject
	 * @var \TYPO3\FLOW3\Security\AccountFactory
	 */
	protected $accountFactory;

	/**
	 * The authentication manager
	 * @var \TYPO3\FLOW3\Security\Authentication\AuthenticationManagerInterface
	 * @inject
	 */
	protected $authenticationManager;

	/**
	 * Shows a list of shopping baskets
	 *
	 * @return void
	 */
	public function indexAction() {
		$this->view->assign('shoppingBasket', $this->shoppingBasket);
		$this->view->assign('securityContext', $this->securityContext);
		$this->view->assign('session', $this->session);
	}

	/**
	 * Adds some item to the basket
	 *
	 * @return void
	 */
	public function addAction() {
		$item = new Item();
		$item->setName(uniqid('Some item'));

		$this->shoppingBasket->addItem($item);

		$this->redirect('index');
	}

	/**
	 * Creates an admin user
	 */
	public function createAccountAction() {
		$account = $this->accountRepository->findOneByAccountIdentifier('admin');
		if ($account === NULL) {
			$account = $this->accountFactory->createAccountWithPassword('admin', 'password', array('Administrator', 'User'));
			$this->accountRepository->add($account);
		}
		$this->redirect('index');
	}

	/**
	 *
	 */
	public function authenticateAction() {
		$this->authenticationManager->authenticate();
		$this->redirect('index');
	}

}

?>