<?php
namespace Backoffice\Factory;

use Backoffice\Controller\LoginController;
use Backoffice\Form\LoginForm;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class LoginFactory
 * @package Backoffice\Factory
 */
class LoginFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return LoginController|mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $sm = $serviceLocator->getServiceLocator();

        $form = new LoginForm();

        $controller = new LoginController();
        $controller->setLoginForm($form);
        $controller->setAuthAdapter($sm->get('AuthService'));
        return $controller;
    }
}
