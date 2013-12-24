<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * IndexController
 *
 * @uses     AbstractActionController
 *
 * @category Controller
 * @package  Application
 * @author   Concetto Vecchio <info@cvsolutions.it>
 * @license  http://framework.zend.com/license/new-bsd New BSD License
 * @link     http://www.php-night.it
 */
class IndexController extends AbstractActionController
{
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
				'articles' => $this->getDirectoryModel()->getByHome()
			));
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
