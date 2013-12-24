<?php
namespace Backoffice\Service;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * ConvertResultSetSQLtoArray
 *
 * @uses     implements
 *
 * @category Service
 * @package  Backoffice
 * @author   Concetto Vecchio <info@cvsolutions.it>
 * @license  http://framework.zend.com/license/new-bsd New BSD License
 * @link     http://www.php-night.it
 */
class ConvertResultSetSQLtoArray implements ServiceLocatorAwareInterface
{
    /**
     * $ServiceLocator
     *
     * @var ServiceLocatorInterface
     *
     * @access protected
     */
    protected $ServiceLocator;

    /**
     * getSelectCategories
     *
     * @access public
     *
     * @return mixed Value.
     */
    public function getSelectCategories()
    {
        $Categories = $this->getServiceLocator()->get('Application\Model\Categories');
        $getFull = $Categories->getFull();
        foreach ($getFull as $row) {
            $option[$row['id']] = $row['fullname'];
        }
        return $option;
    }

    /**
     * Gets the $ServiceLocator.
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->ServiceLocator;
    }

    /**
     * Sets the $ServiceLocator.
     *
     * @param ServiceLocatorInterface $ServiceLocator the ServiceLocator
     *
     * @return self
     */
    public function setServiceLocator(ServiceLocatorInterface $ServiceLocator)
    {
        $this->ServiceLocator = $ServiceLocator;

        return $this;
    }
}
