<?php
namespace Backoffice\Factory;

use Backoffice\Controller\DashboardController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class DashboardFactory
 * @package Backoffice\Factory
 */
class DashboardFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return DashboardController|mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $sm = $serviceLocator->getServiceLocator();

        $controller = new DashboardController();
        return $controller;
    }
}
