<?php
namespace Backoffice\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Backoffice\Controller\DirectoryController;
use Backoffice\Form\DirectoryForm;

/**
 * DirectoryFactory
 *
 * @uses     implements
 *
 * @category Factory
 * @package  Backoffice
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

		$AuthService = $sm->get('AuthService');
		$Categories = $sm->get('Application\Model\Categories');
		$ConvertResultSetSQLtoArray = $sm->get('Backoffice\Service\ConvertResultSetSQLtoArray');

		$form = new DirectoryForm('', array(
				'categories' => $ConvertResultSetSQLtoArray->getSelectCategories(),
				'auth' => $AuthService->getIdentity()->id
			));

		$controller = new DirectoryController();
		$controller->setDirectoryForm($form);
		$controller->setDirectoryModel($sm->get('Application\Model\Directory'));
		return $controller;
	}
}
