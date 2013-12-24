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
class DirectoryController extends AbstractActionController
{
	const MSG = 'Operazione eseguita con successo';

	/**
	 * $_DirectoryForm
	 *
	 * @var mixed
	 *
	 * @access protected
	 */
	protected $_DirectoryForm;

	/**
	 * $_DirectoryModel
	 *
	 * @var mixed
	 *
	 * @access protected
	 */
	protected $_DirectoryModel;

	/**
	 * indexAction
	 *
	 * @access public
	 *
	 * @return mixed Value.
	 */
	public function indexAction()
	{
		return new ViewModel(array(
				'directory' => $this->getDirectoryModel()->getFull(),
				'message' => $this->flashMessenger()->getMessages()
			));
	}

	/**
	 * addAction
	 *
	 * @access public
	 *
	 * @return mixed Value.
	 */
	public function addAction()
	{
		$form = $this->getDirectoryForm();
		$request = $this->getRequest();

		if ($request->isPost()) {

			$post = $request->getPost();
			$form->setData($post);

			if ($form->isValid()) {
				$this->getDirectoryModel()->getInsert($post);
				$this->flashMessenger()->addMessage(array('success', self::MSG));
				return $this->redirect()->toRoute('backoffice/directory');
			}
		}

		return new ViewModel(array(
				'form' => $form
			));
	}

	/**
	 * editAction
	 *
	 * @access public
	 *
	 * @return mixed Value.
	 */
	public function editAction()
	{
		$ID = $this->params('id', 0);
		$row = $this->getDirectoryModel()->getByID($ID);

		$form = $this->getDirectoryForm();
		$form->setData($row);

		$request = $this->getRequest();

		if ($request->isPost()) {

			$post = $request->getPost();
			$form->setData($post);

			if ($form->isValid()) {
				$this->getDirectoryModel()->getUpdate($ID, $post);
				$this->flashMessenger()->addMessage(array('success', self::MSG));
				return $this->redirect()->toRoute('backoffice/directory');
			}
		}

		return new ViewModel(array(
				'form' => $form
			));
	}

	/**
	 * deleteAction
	 *
	 * @access public
	 *
	 * @return mixed Value.
	 */
	public function deleteAction()
	{
		$ID = $this->params('id', 0);
		$this->getDirectoryModel()->getDelete($ID);
		$this->flashMessenger()->addMessage(array('success', self::MSG));
		return $this->redirect()->toRoute('backoffice/directory');
	}

	/**
	 * Gets the value of _DirectoryForm.
	 *
	 * @return mixed
	 */
	public function getDirectoryForm()
	{
		return $this->_DirectoryForm;
	}

	/**
	 * Sets the value of _DirectoryForm.
	 *
	 * @param mixed $_DirectoryForm the _DirectoryForm
	 *
	 * @return self
	 */
	public function setDirectoryForm($DirectoryForm)
	{
		$this->_DirectoryForm = $DirectoryForm;

		return $this;
	}

	/**
	 * Gets the value of _DirectoryModel.
	 *
	 * @return mixed
	 */
	public function getDirectoryModel()
	{
		return $this->_DirectoryModel;
	}

	/**
	 * Sets the value of _DirectoryModel.
	 *
	 * @param mixed $_DirectoryModel the _DirectoryModel
	 *
	 * @return self
	 */
	public function setDirectoryModel($DirectoryModel)
	{
		$this->_DirectoryModel = $DirectoryModel;

		return $this;
	}
}
