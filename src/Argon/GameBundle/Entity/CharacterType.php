<?php

namespace Argon\GameBundle\Entity;

class CharacterType
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var \Argon\GameBundle\Entity\Character
     */
    protected $character;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var integer
     */
    protected $modifier;

    /**
     * @param \Argon\GameBundle\Entity\Character $character
     */
    public function setCharacter(Character $character)
    {
        $this->character = $character;
    }

    /**
     * @return \Argon\GameBundle\Entity\Character
     */
    public function getCharacter()
    {
        return $this->character;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param integer $modifier
     */
    public function setModifier($modifier)
    {
        $this->modifier = $modifier;
    }

    /**
     * @return integer
     */
    public function getModifier()
    {
        return $this->modifier;
    }
}