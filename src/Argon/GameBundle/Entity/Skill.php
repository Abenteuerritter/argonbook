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
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $children;

    /**
     * @var \Argon\GameBundle\Entity\Skill
     */
    protected $parent;

    /**
     * @var string
     */
    protected $abilityCode;

    /**
     * @var string
     */
    protected $code;

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
    protected $locale;

    public function __construct()
    {
        $this->children = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @param \Argon\GameBundle\Entity\Race $children
     */
    public function addChildren(Race $children)
    {
        $this->children[] = $children;
    }

    /**
     * @param \Argon\GameBundle\Entity\Race $children
     */
    public function removeChildren(Race $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param \Argon\GameBundle\Entity\Race $parent
     */
    public function setParent(Race $parent = null)
    {
        $this->parent = $parent;
    }

    /**
     * @return \Argon\GameBundle\Entity\Race
     */
    public function getParent()
    {
        return $this->parent;
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
     * @param string $locale
     */
    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }
}