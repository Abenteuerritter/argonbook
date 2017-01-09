<?php

namespace Argon\GameBundle\Provider\Game;

use Argon\GameBundle\Provider\GameInterface;
use Argon\GameBundle\Entity\Character;

class ExodusGame implements GameInterface
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'exodus';
    }

    /**
     * @return array
     */
    public function getInfo()
    {
        return array(
            'callsign' => 'E',
            'fullname' => 'Exodus',
            'category' => 'LARP',

            'description' => array(
                'en' => 'Description of Exodus in English',
            ),
        );
    }

    /**
     * @return array
     */
    public function getGenres()
    {
        return array('MID');
    }

    /**
     * @return array
     */
    public function getAbilities()
    {
        return array('STR', 'DEX', 'WIS');
    }

    /**
     * @return integer
     */
    public function getInitialExperience()
    {
        return 3;
    }

    /**
     * @return integer
     */
    public function calculateLevel(Character $character)
    {
        return abs(round(exp($character->getExperience() / 10)));
    }
}