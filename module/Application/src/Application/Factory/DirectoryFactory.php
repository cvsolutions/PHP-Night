<?php
namespace Application\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Application\Controller\DirectoryController;

/**
 * DirectoryFactory
 *
 * @uses     implements
 *
 * @category Factory
 * @package  Application
 * @author   Concetto Vecchio <info@cvsolutions.it>
 * @license  http://framework.zend.com/license/new-bsd New BSD License
 * @link     http://www.php-night.it
 */
class DirectoryFactory implements FactoryInterface
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

		$controller = new DirectoryController();
		$controller->setCategoriesModel($sm->get('Application\Model\Categories'));
		$controller->setDirectoryModel($sm->get('Application\Model\Directory'));
		return $controller;
	}
}
