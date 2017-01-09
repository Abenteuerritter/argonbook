<?php

namespace Argon\GameBundle\Provider;

use Argon\GameBundle\Entity\Character;

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
    public function getGenres();

    /**
     * @return array
     */
    public function getAbilities();

    /**
     * @return integer
     */
    public function getInitialExperience();

    /**
     * @return integer
     */
    public function calculateLevel(Character $character);
}