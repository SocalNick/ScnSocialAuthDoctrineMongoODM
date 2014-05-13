<?php
return array(
    'doctrine' => array(
        'driver' => array(
            'ScnSocialAuth-Entity' => array(
                'class' => 'Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver',
            ),
            'odm_default' => array(
                'drivers' => array(
                    'ScnSocialAuthDoctrineMongoODM\Document'  => 'ScnSocialAuth-Entity'
                )
            )
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'ScnSocialAuth-ModuleOptions' => 'ScnSocialAuthDoctrineMongoODM\Service\ModuleOptionsFactory',
            'ScnSocialAuth-UserProviderMapper' => 'ScnSocialAuthDoctrineMongoODM\Service\UserProviderMapperFactory',
        ),
    ),
);