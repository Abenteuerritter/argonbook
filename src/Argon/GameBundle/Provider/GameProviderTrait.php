<?php

namespace Argon\GameBundle\Provider;

/**
 * Implements GameProviderInterface
 */
trait GameProviderTrait
{
    /**
     * @var \Argon\GameBundle\Provider\GameInterface
     */
    protected $game;

    /**
     * @var string
     */
    protected $gameName;

    /**
     * @param \Argon\GameBundle\Provider\GameInterface $game
     */
    public function setGame(GameInterface $game)
    {
        $this->game     = $game;
        $this->gameName = $game->getName();
    }

    /**
     * @return \Argon\GameBundle\Provider\GameInterface
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * @return string
     */
    public function getGameName()
    {
        return $this->gameName;
    }
}