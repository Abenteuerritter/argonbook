<?php

namespace Argon\GameBundle\Entity;

class CharacterExperience
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
     * @var \DateTime
     */
    protected $at;

    /**
     * @var integer
     */
    protected $value;

    /**
     * @var string
     */
    protected $reason;

    public function __construct()
    {
        $this->at = new \DateTime();
    }

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
     * @param \DateTime $at
     */
    public function setAt(\DateTime $at)
    {
        $this->at = $at;
    }

    /**
     * @return \DateTime
     */
    public function getAt()
    {
        return $this->at;
    }

    /**
     * @param integer $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return integer
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $reason
     */
    public function setReason($reason)
    {
        $this->reason = $reason;
    }

    /**
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }
}