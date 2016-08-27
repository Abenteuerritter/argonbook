<?php

namespace Argon\GameBundle\Provider;

/**
 * Provides game interface to an entity.
 */
interface GameProviderInterface
{
    /**
     * @param \Argon\GameBundle\Provider\GameInterface $game
     */
    public function setGame(GameInterface $game);

    /**
     * @return \Argon\GameBundle\Provider\GameInterface
     */
    public function getGame();

    /**
     * @return string
     */
    public function getGameName();
}