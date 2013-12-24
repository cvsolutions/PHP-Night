<?php
namespace Backoffice\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * DirectoryController
 *
 * @uses     AbstractActionController
 *
 * @category Controller
 * @package  Backoffice
 * @author   Concetto Vecchio <info@cvsolutions.it>
 * @license  http://framework.zend.com/license/new-bsd New BSD License
 * @link     http://www.php-night.it
 */
class LoginController extends AbstractActionController
{
	/**
	 * $_LoginForm
	 *
	 * @var mixed
	 *
	 * @access protected
	 */
	protected $_LoginForm;

	/**
	 * $_AuthAdapter
	 *
	 * @var mixed
	 *
	 * @access protected
	 */
	protected $_AuthAdapter;

	/**
	 * indexAction
	 *
	 * @access public
	 *
	 * @return mixed Value.
	 */
	public function indexAction()
	{
		$form = $this->getLoginForm();
		$request = $this->getRequest();

		if ($request->isPost()) {

			$post = $request->getPost();
			$form->setData($post);

			if ($form->isValid()) {

				$this->getAuthAdapter()->getAdapter()->setTableName('pn_auth');
				$this->getAuthAdapter()->getAdapter()->setIdentity($post->get('usermail'));
				$this->getAuthAdapter()->getAdapter()->setCredential($post->get('pwd'));

				$result = $this->getAuthAdapter()->authenticate();

				if ($result->isValid()) {

					$user = $this->getAuthAdapter()->getAdapter()->getResultRowObject();
					$this->getAuthAdapter()->getStorage()->write($user);
					return $this->redirect()->toRoute('backoffice/dashboard');

				} else {

					$this->flashMessenger()->addMessage(array(
							'danger',
							'Indirizzo E-mail o password errati!'
						));
					return $this->redirect()->toRoute('backoffice');
				}
			}
		}

		return new ViewModel(array(
				'form' => $form,
				'message' => $this->flashMessenger()->getMessages()
			));
	}

	/**
	 * logoutAction
	 *
	 * @access public
	 *
	 * @return mixed Value.
	 */
	public function logoutAction()
	{
		$this->getAuthAdapter()->clearIdentity();
		return $this->redirect()->toRoute('home');
	}

	/**
	 * Gets the value of _LoginForm.
	 *
	 * @return mixed
	 */
	public function getLoginForm()
	{
		return $this->_LoginForm;
	}

	/**
	 * Sets the value of _LoginForm.
	 *
	 * @param mixed $_LoginForm the _LoginForm
	 *
	 * @return self
	 */
	public function setLoginForm($LoginForm)
	{
		$this->_LoginForm = $LoginForm;

		return $this;
	}

	/**
	 * Gets the value of _AuthAdapter.
	 *
	 * @return mixed
	 */
	public function getAuthAdapter()
	{
		return $this->_AuthAdapter;
	}

	/**
	 * Sets the value of _AuthAdapter.
	 *
	 * @param mixed $_AuthAdapter the _AuthAdapter
	 *
	 * @return self
	 */
	public function setAuthAdapter($AuthAdapter)
	{
		$this->_AuthAdapter = $AuthAdapter;

		return $this;
	}
}
