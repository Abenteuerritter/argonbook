<?php

namespace Argon\GameBundle\Entity;

class CharacterType
{
    protected $id;

    protected $generalEnabled = false;

    public function getGeneralEnabled()
    {
        return $this->generalEnabled;
    }

    public function setGeneralEnabled($enabled)
    {
        $this->generalEnabled = $enabled;
    }
}