<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * DirectoryController
 *
 * @uses     AbstractActionController
 *
 * @category Controller
 * @package  Application
 * @author   Concetto Vecchio <info@cvsolutions.it>
 * @license  http://framework.zend.com/license/new-bsd New BSD License
 * @link     http://www.php-night.it
 */
class DirectoryController extends AbstractActionController
{
    /**
     * $_CategoriesModel
     *
     * @var mixed
     *
     * @access protected
     */
    protected $_CategoriesModel;

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
        $q = $this->getRequest()->getQuery('q', false);
        return new ViewModel(array(
                'q' => $q,
                'articles' => $this->getDirectoryModel()->getBySearch($q)
            ));
    }

    /**
     * categoryAction
     *
     * @access public
     *
     * @return mixed Value.
     */
    public function categoryAction()
    {
        $slug = $this->params('slug', '');
        $row = $this->getCategoriesModel()->getBySlug($slug);
        if (empty($row)) $this->getResponse()->setStatusCode(404);
        return new ViewModel(array(
                'category' => $row,
                'articles' => $this->getDirectoryModel()->getByCategory($row['id'])
            ));
    }

    /**
     * tagAction
     *
     * @access public
     *
     * @return mixed Value.
     */
    public function tagAction()
    {
        return new ViewModel();
    }

    /**
     * detailAction
     *
     * @access public
     *
     * @return mixed Value.
     */
    public function detailAction()
    {
        $slug = $this->params('slug', '');
        $row = $this->getDirectoryModel()->getBySlug($slug);
        if(empty($row)) throw new \Exception('Questo Link non esiste...');
        return new ViewModel(array('row' => $row));
    }

    /**
     * Gets the value of _CategoriesModel.
     *
     * @return mixed
     */
    public function getCategoriesModel()
    {
        return $this->_CategoriesModel;
    }

    /**
     * Sets the value of _CategoriesModel.
     *
     * @param mixed $_CategoriesModel the _CategoriesModel
     *
     * @return self
     */
    public function setCategoriesModel($CategoriesModel)
    {
        $this->_CategoriesModel = $CategoriesModel;

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
