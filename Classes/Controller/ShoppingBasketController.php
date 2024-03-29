<?php
namespace TYPO3\FLOW3\Test\Session\Controller;

/*                                                                        *
 * This script belongs to the FLOW3 package "TYPO3.FLOW3.Test.Session".   *
 *                                                                        *
 *                                                                        */

use \TYPO3\FLOW3\MVC\Controller\ActionController;
use \TYPO3\FLOW3\Test\Session\Domain\Model\ShoppingBasket;
use \TYPO3\FLOW3\Test\Session\Domain\Model\Item;

use Doctrine\ORM\Mapping as ORM;
use TYPO3\FLOW3\Annotations as FLOW3;

/**
 * ShoppingBasket controller for the TYPO3.FLOW3.Test.Session package
 *
 * @FLOW3\Scope("singleton")
 */
class ShoppingBasketController extends ActionController {

	/**
	 * @FLOW3\Inject
	 * @var \TYPO3\FLOW3\Security\Context
	 */
	protected $securityContext;

	/**
	 * @FLOW3\Inject
	 * @var \TYPO3\FLOW3\Session\SessionInterface
	 */
	protected $session;

	/**
	 * @FLOW3\Inject
	 * @var \TYPO3\FLOW3\Test\Session\Domain\Model\ShoppingBasket
	 */
	protected $shoppingBasket;

	/**
	 * @FLOW3\Inject
	 * @var \TYPO3\FLOW3\Test\Session\Domain\Repository\ItemRepository
	 */
	protected $itemRepository;

	/**
	 * @FLOW3\Inject
	 * @var \TYPO3\FLOW3\Security\AccountRepository
	 */
	protected $accountRepository;

	/**
	 * @FLOW3\Inject
	 * @var \TYPO3\FLOW3\Security\AccountFactory
	 */
	protected $accountFactory;

	/**
	 * The authentication manager
	 * @var \TYPO3\FLOW3\Security\Authentication\AuthenticationManagerInterface
	 * @FLOW3\Inject
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
#\TYPO3\FLOW3\var_dump($this->shoppingBasket);
#return 'x';
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
	 * @return void
	 */
	public function authenticateAction() {
		$this->authenticationManager->authenticate();
		$this->redirect('index');
	}

	/**
	 * @return void
	 */
	public function logoutAction() {
		$this->authenticationManager->logout();
		$this->redirect('index');
	}

}

?>