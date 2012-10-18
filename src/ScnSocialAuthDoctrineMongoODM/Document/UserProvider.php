<?php
namespace ScnSocialAuthDoctrineMongoODM\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use ScnSocialAuth\Entity\UserProviderInterface;

/** @ODM\Document(collection="user_provider") */
class UserProvider implements UserProviderInterface
{
    /** @ODM\Id */
    private $id;

    /** @ODM\String */
    private $userId;

    /** @ODM\String */
    protected $providerId;

    /** @ODM\String */
    protected $provider;

    /**
     * @return the $userId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param  integer      $userId
     * @return UserProvider
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @return the $providerId
     */
    public function getProviderId()
    {
        return $this->providerId;
    }

    /**
     * @param  integer      $providerId
     * @return UserProvider
     */
    public function setProviderId($providerId)
    {
        $this->providerId = $providerId;

        return $this;
    }

    /**
     * @return the $provider
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @param  string       $provider
     * @return UserProvider
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;

        return $this;
    }
}