<?php
namespace Backoffice\Service;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class ConvertResultSetSQLtoArray
 * @package Backoffice\Service
 */
class ConvertResultSetSQLtoArray implements ServiceLocatorAwareInterface
{
    /**
     * @var ServiceLocatorInterface
     */
    protected $ServiceLocator;

    /**
     * @param \Zend\ServiceManager\ServiceLocatorInterface $ServiceLocator
     */
    public function setServiceLocator(ServiceLocatorInterface $ServiceLocator)
    {
        $this->ServiceLocator = $ServiceLocator;
    }

    /**
     * @return \Zend\ServiceManager\ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->ServiceLocator;
    }

    /**
     * @return mixed
     */
    public function getSelectCategories()
    {
        $Categories = $this->getServiceLocator()->get('Application\Model\Categories');
        $getFull    = $Categories->getFull();
        foreach ($getFull as $row) {
            $option[$row['id']] = $row['fullname'];
        }
        return $option;
    }
}
