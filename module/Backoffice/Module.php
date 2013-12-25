<?php
namespace Backoffice;

use Zend\Authentication\Adapter\DbTable as AuthAdapter;
use Zend\Authentication\AuthenticationService;
use Zend\Mvc\MvcEvent;

/**
 * Class Module
 * @package Backoffice
 */
class Module
{
    /**
     * @param MvcEvent $e
     */
    public function onBootstrap(MvcEvent $e)
    {
        $AuthService = $e->getApplication()->getServiceManager()->get('AuthService');

        $vm = $e->getViewModel();
        $vm->setVariable('auth', $AuthService->getIdentity());
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
     * @return mixed
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * @return array
     */
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'AuthService' => function ($sm) {
                        $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');

                        $authAdapter = new AuthAdapter($dbAdapter);
                        $authAdapter->setIdentityColumn('usermail');
                        $authAdapter->setCredentialColumn('pwd');
                        $authAdapter->setCredentialTreatment('sha1(?) AND active = 1');

                        $authService = new AuthenticationService();
                        $authService->setAdapter($authAdapter);
                        return $authService;
                    },
            ),
        );
    }
}
