<?php

namespace Argon\GameBundle\Entity;

use FOS\Message\Model\PersonInterface;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;

use Doctrine\Common\Collections\ArrayCollection;

use Argon\UserBundle\Entity\Player;
use Argon\GameBundle\Entity\Race;
use Argon\GameBundle\Provider\GameProviderInterface;
use Argon\GameBundle\Provider\GameProviderTrait;

class Character implements UserInterface, EquatableInterface, PersonInterface, GameProviderInterface
{
    use GameProviderTrait;

    /**
     * @var string
     */
    const ROLE_CHARACTER = 'ROLE_PJ';

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var \Argon\UserBundle\Entity\Player
     */
    protected $player;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var integer
     */
    protected $experience = 0; // Initial experience

    /**
     * @var \Doctrine\Common\Collections\Collection|array
     */
    protected $abilities;

    /**
     * @var \Doctrine\Common\Collections\Collection|array
     */
    protected $skills;

    /**
     * @var integer
     */
    protected $skillsExperience = 0;

    /**
     * @var \Argon\GameBundle\Entity\Race
     */
    protected $race;

    /**
     * @var string
     */
    protected $story;

    /**
     * @var boolean
     */
    protected $storyDraft = true;

    /**
     * @var \DateTime
     */
    protected $storyConfirmedAt;

    /**
     * @var string
     */
    protected $note;

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
     * (non-PHPdoc)
     * @see \Symfony\Component\Security\Core\User\EquatableInterface::isEqualTo()
     */
    public function isEqualTo(UserInterface $user)
    {
        if (!$user instanceof Character) {
            return false;
        }

        /** @var \Argon\GameBundle\Entity\Character $user */
        if ($user->getSlug() !== $this->getSlug()) {
            return false;
        }

        return true;
    }

    /**
     * (non-PHPdoc)
     * @see \Symfony\Component\Security\Core\User\UserInterface::getRoles()
     */
    public function getRoles()
    {
        return array(self::ROLE_CHARACTER);
    }

    /**
     * (non-PHPdoc)
     * @see \Symfony\Component\Security\Core\User\UserInterface::getPassword()
     */
    public function getPassword()
    {
        return null;
    }

    /**
     * (non-PHPdoc)
     * @see \Symfony\Component\Security\Core\User\UserInterface::getSalt()
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * (non-PHPdoc)
     * @see \Symfony\Component\Security\Core\User\UserInterface::getUsername()
     */
    public function getUsername()
    {
        return $this->getSlug();
    }

    /**
     * (non-PHPdoc)
     * @see \Symfony\Component\Security\Core\User\UserInterface::eraseCredentials()
     */
    public function eraseCredentials()
    {
        // Nothing
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Argon\UserBundle\Entity\Player $player
     */
    public function setPlayer(Player $player)
    {
        $this->player = $player;
    }

    /**
     * @return \Argon\UserBundle\Entity\Player
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
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
     * @return \Argon\GameBundle\Entity\CharacterAbility|null
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
     * @param integer $experience
     */
    public function addSkillsExperience($experience)
    {
        $this->skillsExperience += $experience;
    }

    /**
     * @param integer $experience
     */
    public function removeSkillsExperience($experience)
    {
        $this->skillsExperience -= $experience;
    }

    /**
     * @param integer $experience
     */
    public function setSkillsExperience($experience)
    {
        $this->skillsExperience = $experience;
    }

    /**
     * @return integer
     */
    public function getSkillsExperience()
    {
        return $this->skillsExperience;
    }

    /**
     * @return integer
     */
    public function getAvailableExperience()
    {
        return $this->experience - $this->skillsExperience;
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

    /**
     * @param boolean $draft
     */
    public function setStoryDraft($draft)
    {
        $this->storyDraft = $draft;
    }

    /**
     * @return boolean
     */
    public function getStoryDraft()
    {
        return $this->storyDraft;
    }

    /**
     * @param \DateTime $confirmedAt
     */
    public function setStoryConfirmedAt(\DateTime $confirmedAt)
    {
        $this->storyConfirmedAt = $confirmedAt;
    }

    /**
     * @return \DateTime
     */
    public function getStoryConfirmedAt()
    {
        return $this->storyConfirmedAt;
    }

    /**
     * @var boolean
     */
    public function isStoryNotConfirmed()
    {
        return $this->getStory() !== null &&
               $this->getStoryDraft() === false &&
               $this->getStoryConfirmedAt() === null;
    }

    /**
     * @param string $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }
}