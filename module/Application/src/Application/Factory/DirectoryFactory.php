<?php
namespace Application\Factory;

use Application\Controller\DirectoryController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class DirectoryFactory
 * @package Application\Factory
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

        $controller = new DirectoryController();
        $controller->setCategoriesModel($sm->get('Application\Model\Categories'));
        $controller->setDirectoryModel($sm->get('Application\Model\Directory'));
        return $controller;
    }
}
