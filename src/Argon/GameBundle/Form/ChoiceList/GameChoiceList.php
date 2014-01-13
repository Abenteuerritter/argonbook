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
            $info     = $game->getInfo();
            $category = $info['category'];

            if (!isset($choices[$category]) || !isset($labels[$category])) {
                $choices[$category] = array();
                $labels[$category]  = array();
            }

            $choices[$category][] = $game->getName();
            $labels[$category][]  = array_key_exists('fullname', $info) ? $info['fullname'] : $game->getName();
        }

        return new ChoiceList($choices, $labels);
    }
}