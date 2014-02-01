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
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $abilities;

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