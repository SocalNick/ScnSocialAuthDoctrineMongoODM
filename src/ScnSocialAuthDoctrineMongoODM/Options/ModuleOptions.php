<?php

namespace ScnSocialAuthDoctrineMongoODM\Options;

use ScnSocialAuth\Options\ModuleOptions as BaseModuleOptions;

class ModuleOptions extends BaseModuleOptions
{
    /**
     * @var string
     */
    protected $userProviderEntityClass = 'ScnSocialAuthDoctrineMongoODM\Document\UserProvider';
}
