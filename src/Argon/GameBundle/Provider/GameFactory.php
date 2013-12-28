<?php

namespace Argon\GameBundle\Provider;

class GameFactory
{
    /**
     * @var array
     */
    protected $games;

    public function __construct()
    {
        $this->games = array();
    }

    /**
     * @param \Argon\GameBundle\Provider\GameInterface $game
     */
    public function addGame(GameInterface $game)
    {
        $this->games[$game->getName()] = $game;
    }

    /**
     * Creates a game of the given name. Returns null if the game doesn't
     * exists.
     *
     * @param string $gameName
     *
     * @return \Argon\GameBundle\Provider\GameInterface
     */
    public function create($gameName)
    {
        if (array_key_exists($gameName, $this->games)) {
            return $this->games[$gameName];
        }

        return null;
    }
}