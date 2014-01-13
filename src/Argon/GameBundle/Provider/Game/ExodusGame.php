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
}