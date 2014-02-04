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
    public function getAbilities();

    /**
     * @return integer
     */
    public function getInitialExperience();
}