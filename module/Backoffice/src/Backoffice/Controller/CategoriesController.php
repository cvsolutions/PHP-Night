<?php
namespace Backoffice\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class CategoriesController
 * @package Backoffice\Controller
 */
class CategoriesController extends AbstractActionController
{
    const MSG = 'Operazione eseguita con successo';
    protected $_CategoryForm;
    protected $_CategoriesModel;

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
     * @param mixed $CategoryForm
     */
    public function setCategoryForm($CategoryForm)
    {
        $this->_CategoryForm = $CategoryForm;
    }

    /**
     * @return mixed
     */
    public function getCategoryForm()
    {
        return $this->_CategoryForm;
    }

    /**
     * @return array|ViewModel
     */
    public function indexAction()
    {
        return new ViewModel(array(
            'categories' => $this->getCategoriesModel()->getFull(),
            'message' => $this->flashMessenger()->getMessages()
        ));
    }

    /**
     * @return \Zend\Http\Response|ViewModel
     */
    public function addAction()
    {
        $form    = $this->getCategoryForm();
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
     * @return \Zend\Http\Response|ViewModel
     */
    public function editAction()
    {
        $ID  = $this->params('id', 0);
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
     * @return \Zend\Http\Response
     */
    public function deleteAction()
    {
        $ID = $this->params('id', 0);
        $this->getCategoriesModel()->getDelete($ID);
        $this->flashMessenger()->addMessage(array('success', self::MSG));
        return $this->redirect()->toRoute('backoffice/categories');
    }
}
