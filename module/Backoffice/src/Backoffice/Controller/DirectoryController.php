<?php
namespace Backoffice\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class DirectoryController
 * @package Backoffice\Controller
 */
class DirectoryController extends AbstractActionController
{
    const MSG = 'Operazione eseguita con successo';
    protected $_DirectoryForm;
    protected $_DirectoryModel;

    /**
     * @param mixed $DirectoryForm
     */
    public function setDirectoryForm($DirectoryForm)
    {
        $this->_DirectoryForm = $DirectoryForm;
    }

    /**
     * @return mixed
     */
    public function getDirectoryForm()
    {
        return $this->_DirectoryForm;
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
        return new ViewModel(array(
            'directory' => $this->getDirectoryModel()->getFull(),
            'message' => $this->flashMessenger()->getMessages()
        ));
    }

    /**
     * @return \Zend\Http\Response|ViewModel
     */
    public function addAction()
    {
        $form    = $this->getDirectoryForm();
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
     * @return \Zend\Http\Response|ViewModel
     */
    public function editAction()
    {
        $ID  = $this->params('id', 0);
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
     * @return \Zend\Http\Response
     */
    public function deleteAction()
    {
        $ID = $this->params('id', 0);
        $this->getDirectoryModel()->getDelete($ID);
        $this->flashMessenger()->addMessage(array('success', self::MSG));
        return $this->redirect()->toRoute('backoffice/directory');
    }
}
