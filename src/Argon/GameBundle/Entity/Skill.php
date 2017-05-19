<?php

namespace Argon\GameBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Translatable\Translatable;

class Skill implements Translatable
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var \Doctrine\Common\Collections\Collection|array
     */
    protected $requirements;

    /**
     * @var string
     */
    protected $abilityCode;

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
    protected $modifier;

    /**
     * @var integer
     */
    protected $max;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $locale;

    public function __construct()
    {
        $this->requirements = new ArrayCollection();
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
     * @param \Argon\GameBundle\Entity\Skill $requirement
     */
    public function addRequirement(Skill $requirement)
    {
        $this->requirements[] = $requirement;
    }

    /**
     * @param \Argon\GameBundle\Entity\Skill $requirement
     */
    public function removeRequirement(Skill $requirement)
    {
        $this->requirements->removeElement($requirement);
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRequirements()
    {
        return $this->requirements;
    }

    /**
     * @param string $abilityCode
     */
    public function setAbilityCode($abilityCode = null)
    {
        $this->abilityCode = $abilityCode;
    }

    /**
     * @return string
     */
    public function getAbilityCode()
    {
        return $this->abilityCode;
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

    /**
     * @param integer $max
     */
    public function setMax($max = null)
    {
        $this->max = $max;
    }

    /**
     * @return integer
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * @param string $description
     */
    public function setDescription($description = null)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $locale
     */
    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }
}