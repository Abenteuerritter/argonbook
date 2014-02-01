<?php

namespace Argon\GameBundle\Provider\Game;

use Argon\GameBundle\Provider\GameInterface;

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
    public function getAbilities()
    {
        return array('STR', 'DEX', 'WIS');
    }
}