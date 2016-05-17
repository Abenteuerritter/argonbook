<?php

namespace Argon\GameBundle\Form\ChoiceList;

use Symfony\Component\Form\ChoiceList\Loader\ChoiceLoaderInterface;
use Symfony\Component\Form\ChoiceList\ArrayChoiceList;

use Argon\GameBundle\Provider\GameFactory;
use Argon\GameBundle\Provider\GameInterface;

class GameChoiceLoader implements ChoiceLoaderInterface
{
    /**
     * @var \Argon\GameBundle\Provider\GameFactory
     */
    protected $gameFactory;

    public function __construct(GameFactory $gameFactory)
    {
        $this->gameFactory = $gameFactory;
    }

    private function withGame(array $choices, GameInterface $game, $value = null)
    {

        return $choices;
    }

    public function loadChoiceList($value = null)
    {
        $choices = array();

        foreach ($this->gameFactory->getGames() as $game) {
            $info     = $game->getInfo();
            $category = $info['category'];

            if (!isset($choices[$category]) || !isset($labels[$category])) {
                $choices[$category] = array();
            }

            if (is_callable($value)) {
                $key = call_user_func($value, $game);
            } else {
                $key = $game->getName();
            }

            $choices[$category][$key] = array_key_exists('fullname', $info) ? $info['fullname'] : $game->getName();
        }

        return new ArrayChoiceList($choices, $value);
    }

    public function loadChoicesForValues(array $values, $value = null)
    {
        $array = array();
        $games = $this->gameFactory->getGames();

        foreach ($values as $i => $left) {
            foreach ($games as $right) {
                if (is_callable($value)) {
                    $left  = call_user_func($value, $left); // XXX Necessary?
                    $right = call_user_func($value, $right);
                }

                if ($left === $right) {
                    $array[$i] = $right;
                }
            }
        }

        return $array;
    }

    public function loadValuesForChoices(array $choices, $value = null)
    {
        $array = array();
        $games = $this->gameFactory->getGames();

        foreach ($choices as $i => $left) {
            foreach ($games as $right) {
                if (is_callable($value)) {
                    $left  = call_user_func($value, $left);
                    $right = call_user_func($value, $right);
                }

                if ($left === $right) {
                    $array[$i] = $right;
                }
            }
        }

        return $array;
    }
}