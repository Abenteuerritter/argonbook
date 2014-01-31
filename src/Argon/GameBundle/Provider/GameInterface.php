<?php

namespace Argon\GameBundle\Provider;

interface GameInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @return array
     */
    public function getInfo();

    /**
     * @return array
     */
    public function getCharacterTypes();
}