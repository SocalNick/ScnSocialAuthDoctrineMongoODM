<?php
namespace ScnSocialAuthDoctrineMongoODM\Mapper;

use Doctrine\ODM\MongoDB\DocumentManager;
use ZfcBase\Mapper\AbstractDbMapper;
use ScnSocialAuth\Mapper\UserProviderInterface;
use ScnSocialAuthDoctrineMongoODM\Options\ModuleOptions;
use Zend\Stdlib\Hydrator\HydratorInterface;

class UserProvider extends AbstractDbMapper implements UserProviderInterface
{
    /**
     * @var \Doctrine\ODM\MongoDB\DocumentManager;
     */
    protected $dm;

    /**
     * @var \ScnSocialAuthDoctrineMongoODM\Options\ModuleOptions
     */
    protected $options;

    public function __construct(DocumentManager $dm, ModuleOptions $options)
    {
        $this->dm      = $dm;
        $this->options = $options;
    }

    public function findUserByProviderId($providerId, $provider)
    {
        $er = $this->dm->getRepository($this->options->getUserProviderEntityClass());
        $entity = $er->findOneBy(array('providerId' => $providerId, 'provider' => $provider));
        return $entity;
    }

    public function insert($document, $tableName = null, HydratorInterface $hydrator = null)
    {
        return $this->persist($document);
    }

    public function update($document, $where = null, $tableName = null, HydratorInterface $hydrator = null)
    {
        return $this->persist($document);
    }

    protected function persist($document)
    {
        $this->dm->persist($document);
        $this->dm->flush();

        return $document;
    }
}