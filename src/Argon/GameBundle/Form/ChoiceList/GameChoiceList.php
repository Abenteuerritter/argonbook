<?php

namespace Argon\GameBundle\Form\ChoiceList;

use Symfony\Component\Form\Extension\Core\ChoiceList\LazyChoiceList;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;

use Argon\GameBundle\Provider\GameFactory;

class GameChoiceList extends LazyChoiceList
{
    /**
     * @var \Argon\GameBundle\Provider\GameFactory
     */
    protected $gameFactory;

    public function __construct(GameFactory $gameFactory)
    {
        $this->gameFactory = $gameFactory;
    }

    protected function loadChoiceList()
    {
        $choices = array();
        $labels  = array();

        $games = $this->gameFactory->getGames();

        foreach ($games as $game) {
            $choices[] = $game->getName();
            $labels[]  = $game->getName();
        }

        return new ChoiceList($choices, $labels);
    }
}