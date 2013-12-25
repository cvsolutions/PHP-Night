<?php
namespace Application;

use Zend\Mvc\MvcEvent;

use Application\Model\CategoriesModel;
use Application\Model\DirectoryModel;

/**
 * Module
 *
 * @uses
 *
 * @category Module
 * @package  Application
 * @author   Concetto Vecchio <info@cvsolutions.it>
 * @license  http://framework.zend.com/license/new-bsd New BSD License
 * @link     http://www.php-night.it
 */
class Module
{
    /**
     * onBootstrap
     *
     * @param mixed \MvcEvent.
     *
     * @access public
     *
     * @return mixed Value.
     */
    public function onBootstrap(MvcEvent $e)
    {
        $Categories = $e->getApplication()->getServiceManager()->get('Application\Model\Categories');

        $vm = $e->getViewModel();
        $vm->setVariable('categories_top', $Categories->getFullByMenu(1));
        $vm->setVariable('categories_right', $Categories->getFullByMenu(2));
    }

    /**
     * getConfig
     *
     * @access public
     *
     * @return mixed Value.
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * getAutoloaderConfig
     *
     * @access public
     *
     * @return mixed Value.
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
     * getServiceConfig
     *
     * @access public
     *
     * @return mixed Value.
     */
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Application\Model\Categories' => function ($sm)
                {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    return new CategoriesModel($dbAdapter);
                },
                'Application\Model\Directory' => function ($sm)
                {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    return new DirectoryModel($dbAdapter);
                },
            )
        );
    }
}
