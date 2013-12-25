<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class IndexController
 * @package Application\Controller
 */
class IndexController extends AbstractActionController
{
    protected $_DirectoryModel;

    /**
     * @param mixed $DirectoryModel
     */
    public function setDirectoryModel($DirectoryModel)
    {
        $this->_DirectoryModel = $DirectoryModel;
    }

    /**
     * @return mixed
     */
    public function getDirectoryModel()
    {
        return $this->_DirectoryModel;
    }

    /**
     * @return array|ViewModel
     */
    public function indexAction()
    {
        return new ViewModel(array(
            'articles' => $this->getDirectoryModel()->getByHome()
        ));
    }
}
