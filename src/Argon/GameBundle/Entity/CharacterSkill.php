<?php

namespace Argon\GameBundle\Entity;

class CharacterSkill
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
     * @var \Argon\GameBundle\Entity\Skill
     */
    protected $skill;

    /**
     * @var integer
     */
    protected $level;

    public function __construct()
    {
        $this->at = new \DateTime();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
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
     * @param \Argon\GameBundle\Entity\Skill $skill
     */
    public function setSkill(Skill $skill)
    {
        $this->skill = $skill;
    }

    /**
     * @return \Argon\GameBundle\Entity\Skill
     */
    public function getSkill()
    {
        return $this->skill;
    }

    /**
     * @param integer $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * @return integer
     */
    public function getLevel()
    {
        return $this->level;
    }
}