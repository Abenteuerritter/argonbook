<?php

namespace Argon\GameBundle\Entity;

class Game
{
    protected $id;

    protected $name;

    protected $system;

    protected $character;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getSystem()
    {
        return $this->system;
    }

    public function setSystem($system)
    {
        $this->system = $system;
    }

    public function getCharacter()
    {
        return $this->character;
    }

    public function setCharacter(CharacterType $character)
    {
        $this->character = $character;
    }
}