<?php
/**
 * ScnSocialAuthDoctrineMongoODM Module
 *
 * @category   ScnSocialAuthDoctrineMongoODM
 * @package    ScnSocialAuthDoctrineMongoODM_Service
 */

namespace ScnSocialAuthDoctrineMongoODM\Service;

use ScnSocialAuthDoctrineMongoODM\Mapper\UserProvider;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator;

/**
 * @category   ScnSocialAuthDoctrineMongoODM
 * @package    ScnSocialAuthDoctrineMongoODM_Service
 */
class UserProviderMapperFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $options = $services->get('ScnSocialAuth-ModuleOptions');
        $entityClass = $options->getUserProviderEntityClass();

        $mapper = new UserProvider($services->get('doctrine.documentmanager.odm_default'), $services->get('ScnSocialAuth-ModuleOptions'));
        $mapper->setEntityPrototype(new $entityClass);

        return $mapper;
    }
}
