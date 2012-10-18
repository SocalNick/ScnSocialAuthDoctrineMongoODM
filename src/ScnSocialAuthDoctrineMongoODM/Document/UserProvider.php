<?php
namespace ScnSocialAuthDoctrineMongoODM\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use ScnSocialAuth\Entity\UserProvider as BaseUserProvider;

/** @ODM\Document(collection="user_provider") */
class UserProvider extends BaseUserProvider
{
    /** @ODM\Id */
    private $id;

    /** @ODM\String */
    protected $userId;

    /** @ODM\String */
    protected $providerId;

    /** @ODM\String */
    protected $provider;
}