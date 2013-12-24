<?php
namespace Backoffice\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Backoffice\Controller\CategoriesController;
use Backoffice\Form\CategoryForm;

/**
 * CategoriesFactory
 *
 * @uses     implements
 *
 * @category Factory
 * @package  Backoffice
 * @author   Concetto Vecchio <info@cvsolutions.it>
 * @license  http://framework.zend.com/license/new-bsd New BSD License
 * @link     http://www.php-night.it
 */
class CategoriesFactory implements FactoryInterface
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

		$form = new CategoryForm();

		$controller = new CategoriesController();
		$controller->setCategoryForm($form);
		$controller->setCategoriesModel($sm->get('Application\Model\Categories'));
		return $controller;
	}
}
