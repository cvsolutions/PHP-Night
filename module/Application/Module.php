<?php
namespace Application;

use Application\Model\CategoriesModel;
use Application\Model\DirectoryModel;

use Zend\Mvc\MvcEvent;

/**
 * Class Module
 * @package Application
 */
class Module
{
    /**
     * @param MvcEvent $e
     */
    public function onBootstrap(MvcEvent $e)
    {
        $Categories = $e->getApplication()->getServiceManager()->get('Application\Model\Categories');

        $vm = $e->getViewModel();
        $vm->setVariable('categories_top', $Categories->getFullByMenu(1));
        $vm->setVariable('categories_right', $Categories->getFullByMenu(2));
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
        );
    }

    /**
     * @return array
     */
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Application\Model\Categories' => function ($sm) {
                        $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                        return new CategoriesModel($dbAdapter);
                    },
                'Application\Model\Directory' => function ($sm) {
                        $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                        return new DirectoryModel($dbAdapter);
                    },
            )
        );
    }
}
