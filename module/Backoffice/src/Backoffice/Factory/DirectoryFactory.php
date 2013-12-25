<?php
namespace Backoffice\Factory;

use Backoffice\Controller\DirectoryController;
use Backoffice\Form\DirectoryForm;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class DirectoryFactory
 * @package Backoffice\Factory
 */
class DirectoryFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return DirectoryController|mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $sm = $serviceLocator->getServiceLocator();

        $AuthService                = $sm->get('AuthService');
        $Categories                 = $sm->get('Application\Model\Categories');
        $ConvertResultSetSQLtoArray = $sm->get('Backoffice\Service\ConvertResultSetSQLtoArray');

        $form = new DirectoryForm('', array(
            'categories' => $ConvertResultSetSQLtoArray->getSelectCategories(),
            'auth' => $AuthService->getIdentity()->id
        ));

        $controller = new DirectoryController();
        $controller->setDirectoryForm($form);
        $controller->setDirectoryModel($sm->get('Application\Model\Directory'));
        return $controller;
    }
}
