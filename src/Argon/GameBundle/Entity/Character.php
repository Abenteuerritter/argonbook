<?php

namespace Argon\GameBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Argon\CommonBundle\Entity\Player;
use Argon\GameBundle\Entity\Race;
use Argon\GameBundle\Model\GameProvider;

class Character extends GameProvider
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var \Argon\CommonBundle\Entity\Player
     */
    protected $player;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var integer
     */
    protected $experience = 0; // Initial experience

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $abilities;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $skills;

    /**
     * @var \Argon\GameBundle\Entity\Race
     */
    protected $race;

    /**
     * @var string
     */
    protected $story;

    public function __construct()
    {
        $this->abilities = new ArrayCollection();
        $this->skills = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Argon\CommonBundle\Entity\Player $player
     */
    public function setPlayer(Player $player)
    {
        $this->player = $player;
    }

    /**
     * @return \Argon\CommonBundle\Entity\Player
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param integer $experience
     */
    public function addExperience($experience)
    {
        $this->experience += $experience;
    }

    /**
     * @param integer $experience
     */
    public function removeExperience($experience)
    {
        $this->experience -= $experience;
    }

    /**
     * @param integer $experience
     */
    public function setExperience($experience)
    {
        $this->experience = $experience;
    }

    /**
     * @return integer
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * @param \Argon\GameBundle\Entity\CharacterAbility $ability
     */
    public function addAbility(CharacterAbility $ability)
    {
        $this->abilities[] = $ability;
    }

    /**
     * @param \Argon\GameBundle\Entity\CharacterAbility $ability
     */
    public function removeAbility(CharacterAbility $ability)
    {
        $this->abilities->removeElement($ability);
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAbilities()
    {
        return $this->abilities;
    }

    /**
     * @return \Argon\GameBundle\Entity\CharacterAbility
     */
    public function getAbility($abilityCode)
    {
        $found = $this->abilities->filter(function ($characterAbility) use ($abilityCode) {
            return $characterAbility->getCode() === $abilityCode;
        });

        if (count($found) > 0) {
            return $found->first();
        }

        return null;
    }

    /**
     * @param \Argon\GameBundle\Entity\CharacterSkill $skill
     */
    public function addSkill(CharacterSkill $skill)
    {
        $this->skills[] = $skill;
    }

    /**
     * @param \Argon\GameBundle\Entity\CharacterSkill $skill
     */
    public function removeSkill(CharacterSkill $skill)
    {
        $this->skills->removeElement($skill);
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * @param \Argon\GameBundle\Entity\Race $race
     */
    public function setRace(Race $race)
    {
        $this->race = $race;
    }

    /**
     * @return \Argon\GameBundle\Entity\Race
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * @param string $story
     */
    public function setStory($story)
    {
        $this->story = $story;
    }

    /**
     * @return string
     */
    public function getStory()
    {
        return $this->story;
    }
}