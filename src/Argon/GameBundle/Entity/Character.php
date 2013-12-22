<?php

namespace Argon\GameBundle\Entity;

class Character
{
    protected $id;

    protected $name;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}