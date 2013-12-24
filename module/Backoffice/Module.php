<?php
namespace Backoffice;

use Zend\Mvc\MvcEvent;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;

/**
 * Module
 *
 * @uses
 *
 * @category Module
 * @package  Backoffice
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
        $AuthService = $e->getApplication()->getServiceManager()->get('AuthService');

        $vm = $e->getViewModel();
        $vm->setVariable('auth', $AuthService->getIdentity());
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
                'AuthService' => function($sm)
                {
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
