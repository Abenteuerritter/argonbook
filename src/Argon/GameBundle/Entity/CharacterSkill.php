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

    /**
     * @var integer
     */
    protected $newLevel;

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

    /**
     * @param integer $level
     */
    public function setNewLevel($level)
    {
        $this->newLevel = $level;
    }

    /**
     * @return integer
     */
    public function getNewLevel()
    {
        return $this->newLevel;
    }

    /**
     * @return integer
     */
    public function getNewLevelCost()
    {
        return $this->newLevel * $this->getPrice();
    }

    /**
     * @return integer
     */
    public function getNextLevel()
    {
        return $this->level + $this->newLevel;
    }

    /**
     * @return boolean
     */
    public function isNextRemoved()
    {
        return empty($this->level) && $this->getNextLevel() === 0;
    }

    /**
     * @return integer
     */
    public function getPrice()
    {
        $abilityCode = $this->getSkill()->getAbilityCode();

        if ($abilityCode === null) {
            // If the skill is for all it just cost the what the skill cost
            // normaly.
            return $this->getSkill()->getModifier();
        }

        $characterAbility = $this->getCharacter()->getAbility($abilityCode);

        if ($characterAbility === null) {
            // The character doesn't have the ability of the this skill, so
            // everything cost him 10 times more.
            return 10 * $this->getSkill()->getModifier();
        }

        return $characterAbility->getModifier() * $this->getSkill()->getModifier();
    }
}