<?php
namespace Backoffice\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Backoffice\Controller\LoginController;
use Backoffice\Form\LoginForm;

/**
 * LoginFactory
 *
 * @uses     implements
 *
 * @category Factory
 * @package  Backoffice
 * @author   Concetto Vecchio <info@cvsolutions.it>
 * @license  http://framework.zend.com/license/new-bsd New BSD License
 * @link     http://www.php-night.it
 */
class LoginFactory implements FactoryInterface
{

	/**
	 * createService
	 *
	 * @param mixed \ServiceLocatorInterface.
	 *
	 * @access public
	 *
	 * @return mixed Value.
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
