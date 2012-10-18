<?php
/**
 * ScnSocialAuthDoctrineMongoODM Module
 *
 * @category   ScnSocialAuthDoctrineMongoODM
 * @package    ScnSocialAuthDoctrineMongoODM_Service
 */

namespace ScnSocialAuthDoctrineMongoODM\Service;

use ScnSocialAuthDoctrineMongoODM\Options;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @category   ScnSocialAuthDoctrineORM
 * @package    ScnSocialAuthDoctrineORM_Service
 */
class ModuleOptionsFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $config = $services->get('Configuration');

        return new Options\ModuleOptions(isset($config['scn-social-auth']) ? $config['scn-social-auth'] : array());
    }
}
