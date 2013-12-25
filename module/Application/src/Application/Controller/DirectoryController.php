<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class DirectoryController
 * @package Application\Controller
 */
class DirectoryController extends AbstractActionController
{
    protected $_CategoriesModel;
    protected $_DirectoryModel;

    /**
     * @param mixed $CategoriesModel
     */
    public function setCategoriesModel($CategoriesModel)
    {
        $this->_CategoriesModel = $CategoriesModel;
    }

    /**
     * @return mixed
     */
    public function getCategoriesModel()
    {
        return $this->_CategoriesModel;
    }

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
        $q = $this->getRequest()->getQuery('q', false);
        return new ViewModel(array(
            'q' => $q,
            'articles' => $this->getDirectoryModel()->getBySearch($q)
        ));
    }

    /**
     * @return ViewModel
     */
    public function categoryAction()
    {
        $slug = $this->params('slug', '');
        $row  = $this->getCategoriesModel()->getBySlug($slug);
        if (empty($row)) $this->getResponse()->setStatusCode(404);

        return new ViewModel(array(
            'category' => $row,
            'articles' => $this->getDirectoryModel()->getByCategory($row['id'])
        ));
    }

    /**
     * @return ViewModel
     */
    public function tagAction()
    {
        return new ViewModel();
    }

    /**
     * @return ViewModel
     * @throws \Exception
     */
    public function detailAction()
    {
        $slug = $this->params('slug', '');
        $row  = $this->getDirectoryModel()->getBySlug($slug);
        if (empty($row)) throw new \Exception('Questo Link non esiste...');
        return new ViewModel(array('row' => $row));
    }
}
