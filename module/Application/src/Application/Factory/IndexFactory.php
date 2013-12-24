<?php
namespace Application\Factory;

use \Zend\ServiceManager\FactoryInterface;
use \Zend\ServiceManager\ServiceLocatorInterface;
use Application\Controller\IndexController;

/**
 * IndexFactory
 *
 * @uses     implements
 *
 * @category Factory
 * @package  Application
 * @author   Concetto Vecchio <info@cvsolutions.it>
 * @license  http://framework.zend.com/license/new-bsd New BSD License
 * @link     http://www.php-night.it
 */
class IndexFactory implements FactoryInterface
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

		$controller = new IndexController();
		$controller->setDirectoryModel($sm->get('Application\Model\Directory'));
		return $controller;
	}
}
