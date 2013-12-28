<?php

namespace Argon\GameBundle\Model;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\ORM\Event\LifecycleEventArgs;

use Argon\GameBundle\Provider\GameFactory;

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
            Events::postLoad,
        );
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