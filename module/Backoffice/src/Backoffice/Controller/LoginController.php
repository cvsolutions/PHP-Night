<?php
namespace Backoffice\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class LoginController
 * @package Backoffice\Controller
 */
class LoginController extends AbstractActionController
{
    protected $_LoginForm;
    protected $_AuthAdapter;

    /**
     * @param mixed $AuthAdapter
     */
    public function setAuthAdapter($AuthAdapter)
    {
        $this->_AuthAdapter = $AuthAdapter;
    }

    /**
     * @return mixed
     */
    public function getAuthAdapter()
    {
        return $this->_AuthAdapter;
    }

    /**
     * @param mixed $LoginForm
     */
    public function setLoginForm($LoginForm)
    {
        $this->_LoginForm = $LoginForm;
    }

    /**
     * @return mixed
     */
    public function getLoginForm()
    {
        return $this->_LoginForm;
    }

    /**
     * @return array|\Zend\Http\Response|ViewModel
     */
    public function indexAction()
    {
        $form    = $this->getLoginForm();
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
     * @return \Zend\Http\Response
     */
    public function logoutAction()
    {
        $this->getAuthAdapter()->clearIdentity();
        return $this->redirect()->toRoute('home');
    }
}
