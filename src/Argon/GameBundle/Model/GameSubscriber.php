<?php

namespace Argon\GameBundle\Model;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\ORM\Event\LifecycleEventArgs;

use Argon\GameBundle\Provider\GameFactory;
use Argon\GameBundle\Entity\Character;
use Argon\GameBundle\Entity\CharacterExperience;

/**
 * Will initialize the game after the entity itself was loaded.
 */
class GameSubscriber implements EventSubscriber
{
    /**
     * @var \Argon\GameBundle\Provider\GameFactory
     */
    protected $gameFactory;

    public function __construct(GameFactory $gameFactory)
    {
        $this->gameFactory = $gameFactory;
    }

    public function getSubscribedEvents()
    {
        return array(
            Events::prePersist,
            Events::postLoad,
        );
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity        = $args->getEntity();
        $entityManager = $args->getEntityManager();

        if ($entity instanceof GameProvider && $entity instanceof Character) {
            $value = $entity->getGame()->getInitialExperience();

            $experience = new CharacterExperience();
            $experience->setCharacter($entity);
            $experience->setValue($value);
            $experience->setReason('');

            $entity->addExperience($value);
            $entityManager->persist($experience);
        }
    }

    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof GameProvider) {
            $gameName = $entity->getGameName();
            $game     = $this->gameFactory->create($gameName);

            $entity->setGame($game);
        }
    }
}