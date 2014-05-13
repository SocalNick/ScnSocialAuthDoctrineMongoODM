<?php
namespace ScnSocialAuthDoctrineMongoODM\Mapper;

use Doctrine\ODM\MongoDB\DocumentManager;
use Hybrid_User_Profile;
use ScnSocialAuth\Mapper\Exception;
use ScnSocialAuth\Mapper\UserProviderInterface;
use ScnSocialAuthDoctrineMongoODM\Options\ModuleOptions;
use Zend\Stdlib\Hydrator\HydratorInterface;
use ZfcBase\Mapper\AbstractDbMapper;
use ZfcUser\Entity\UserInterface;

class UserProvider extends AbstractDbMapper implements UserProviderInterface
{
    /**
     * @var DocumentManager;
     */
    protected $dm;

    /**
     * @var ModuleOptions
     */
    protected $options;

    /**
     * @param   DocumentManager   $dm
     * @param   ModuleOptions     $options
     */
    public function __construct(DocumentManager $dm, ModuleOptions $options)
    {
        $this->dm      = $dm;
        $this->options = $options;
    }

    /**
     * @param   string    $providerId
     * @param   string    $provider
     * @return  UserInterface
     */
    public function findUserByProviderId($providerId, $provider)
    {
        $dr = $this->dm->getRepository($this->options->getUserProviderEntityClass());
        $document = $dr->findOneBy(array('providerId' => (string) $providerId, 'provider' => $provider));
        return $document;
    }

    /**
     * @param   UserInterface       $user
     * @param   Hybrid_User_Profile $hybridUserProfile
     * @param   string              $provider
     * @param   array               $accessToken
     */
    public function linkUserToProvider(UserInterface $user, Hybrid_User_Profile $hybridUserProfile, $provider, array $accessToken = null)
    {
        $userProvider = $this->findUserByProviderId($hybridUserProfile->identifier, $provider);

        if (false != $userProvider) {
            if ($user->getId() == $userProvider->getUserId()) {
                // already linked
                return;
            }
            throw new Exception\RuntimeException('This ' . ucfirst($provider) . ' profile is already linked to another user.');
        }

        $userProvider = clone($this->getEntityPrototype());
        $userProvider->setUserId($user->getId())
                     ->setProviderId($hybridUserProfile->identifier)
                     ->setProvider($provider);
        $this->insert($userProvider);
    }

    /**
     * @param   UserInterface     $document
     * @param   string            $tableName
     * @param   HydratorInterface $hydrator
     * @return  UserInterface
     */
    public function insert($document, $tableName = null, HydratorInterface $hydrator = null)
    {
        return $this->persist($document);
    }

    /**
     * @param   UserInterface       $document
     * @param   string              $tableName
     * @param   HydratorInterface   $hydrator
     * @return  UserInterface
     */
    public function update($document, $where = null, $tableName = null, HydratorInterface $hydrator = null)
    {
        return $this->persist($document);
    }

    /**
     * @param   UserInterface   $document
     * @return  UserInterface
     */
    protected function persist($document)
    {
        $this->dm->persist($document);
        $this->dm->flush();

        return $document;
    }

    /**
     * @param  UserInterface               $user
     * @param  string                      $provider
     * @return UserProviderInterface|false
     */
    public function findProviderByUser(UserInterface $user, $provider)
    {
        $dr = $this->dm->getRepository($this->options->getUserProviderEntityClass());
        $document = $dr->findOneBy(array('userId' => $user->getId(), 'provider' => $provider));
        $this->getEventManager()->trigger('find', $this, array('document' => $document));
        return $document;
    }

    /**
     * @param  UserInterface $user
     * @return array
     */
    public function findProvidersByUser(UserInterface $user)
    {
        $dr = $this->dm->getRepository($this->options->getUserProviderEntityClass());
        $documents = $dr->findBy(array('userId' => $user->getId()));

        $return = array();
        foreach ($documents as $document) {
            $return[$document->getProvider()] = $document;
            $this->getEventManager()->trigger('find', $this, array('document' => $document));
        }

        return $return;
    }
}