<?php
namespace Backoffice\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * CategoriesController
 *
 * @uses     AbstractActionController
 *
 * @category Controller
 * @package  Backoffice
 * @author   Concetto Vecchio <info@cvsolutions.it>
 * @license  http://framework.zend.com/license/new-bsd New BSD License
 * @link     http://www.php-night.it
 */
class CategoriesController extends AbstractActionController
{
    const MSG = 'Operazione eseguita con successo';

    /**
     * $_CategoryForm
     *
     * @var mixed
     *
     * @access protected
     */
    protected $_CategoryForm;

    /**
     * $_CategoriesModel
     *
     * @var mixed
     *
     * @access protected
     */
    protected $_CategoriesModel;

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
                'categories' => $this->getCategoriesModel()->getFull(),
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
        $form = $this->getCategoryForm();
        $request = $this->getRequest();

        if ($request->isPost()) {

            $post = $request->getPost();
            $form->setData($post);

            if ($form->isValid()) {
                $this->getCategoriesModel()->getInsert($post);
                $this->flashMessenger()->addMessage(array('success', self::MSG));
                return $this->redirect()->toRoute('backoffice/categories');
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
        $row = $this->getCategoriesModel()->getByID($ID);

        $form = $this->getCategoryForm();
        $form->setData($row);

        $request = $this->getRequest();

        if ($request->isPost()) {

            $post = $request->getPost();
            $form->setData($post);

            if ($form->isValid()) {
                $this->getCategoriesModel()->getUpdate($ID, $post);
                $this->flashMessenger()->addMessage(array('success', self::MSG));
                return $this->redirect()->toRoute('backoffice/categories');
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
        $this->getCategoriesModel()->getDelete($ID);
        $this->flashMessenger()->addMessage(array('success', self::MSG));
        return $this->redirect()->toRoute('backoffice/categories');
    }

    /**
     * Gets the value of _CategoryForm.
     *
     * @return mixed
     */
    public function getCategoryForm()
    {
        return $this->_CategoryForm;
    }

    /**
     * Sets the value of _CategoryForm.
     *
     * @param mixed $_CategoryForm the _CategoryForm
     *
     * @return self
     */
    public function setCategoryForm($CategoryForm)
    {
        $this->_CategoryForm = $CategoryForm;

        return $this;
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
}
