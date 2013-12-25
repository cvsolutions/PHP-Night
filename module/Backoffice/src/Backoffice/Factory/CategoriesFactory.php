<?php
namespace Backoffice\Factory;

use Backoffice\Controller\CategoriesController;
use Backoffice\Form\CategoryForm;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class CategoriesFactory
 * @package Backoffice\Factory
 */
class CategoriesFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return CategoriesController|mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $sm = $serviceLocator->getServiceLocator();

        $form = new CategoryForm();

        $controller = new CategoriesController();
        $controller->setCategoryForm($form);
        $controller->setCategoriesModel($sm->get('Application\Model\Categories'));
        return $controller;
    }
}
