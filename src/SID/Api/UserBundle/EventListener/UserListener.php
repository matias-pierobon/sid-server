<?php
/**
 * Created by PhpStorm.
 * User: matias
 * Date: 4/26/17
 * Time: 9:46 AM
 */

namespace SID\Api\UserBundle\EventListener;


use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use SID\Api\UserBundle\Model\UserInterface;
use SID\Api\UserBundle\Service\PasswordUpdaterService;

class UserListener implements EventSubscriber
{
    private $passwordUpdater;
    public function __construct(PasswordUpdaterService $passwordUpdater)
    {
        $this->passwordUpdater = $passwordUpdater;
    }

    /**
     * {@inheritdoc}
     */
    public function getSubscribedEvents()
    {
        return array(
            'prePersist',
            'preUpdate',
        );
    }

    /**
     * Pre persist listener based on doctrine common.
     *
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $object = $args->getObject();
        if ($object instanceof UserInterface) {
            $this->updateUserFields($object);
        }
    }

    /**
     * Pre update listener based on doctrine common.
     *
     * @param LifecycleEventArgs $args
     */
    public function preUpdate(LifecycleEventArgs $args)
    {
        $object = $args->getObject();
        if ($object instanceof UserInterface) {
            $this->updateUserFields($object);
            $this->recomputeChangeSet($args->getObjectManager(), $object);
        }
    }

    /**
     * Updates the user properties.
     *
     * @param UserInterface $user
     */
    private function updateUserFields(UserInterface $user)
    {
        $this->passwordUpdater->hashPassword($user);
    }

    /**
     * Recomputes change set for Doctrine implementations not doing it automatically after the event.
     *
     * @param ObjectManager $om
     * @param UserInterface $user
     */
    private function recomputeChangeSet(ObjectManager $om, UserInterface $user)
    {
        $meta = $om->getClassMetadata(get_class($user));
        if ($om instanceof EntityManager) {
            $om->getUnitOfWork()->recomputeSingleEntityChangeSet($meta, $user);
            return;
        }
    }
}