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
     * @var integer
     */
    protected $root;

    /**
     * @var integer
     */
    protected $left;

    /**
     * @var integer
     */
    protected $right;

    /**
     * @var integer
     */
    protected $level;

    /**
     * @var \Argon\GameBundle\Entity\Skill
     */
    protected $parent;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $children;

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
     * @param integer $root
     */
    public function setRoot($root = null)
    {
        $this->root = $root;
    }

    /**
     * @return integer
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * @param integer $left
     */
    public function setLeft($left)
    {
        $this->left = $left;
    }

    /**
     * @return integer
     */
    public function getLeft()
    {
        return $this->left;
    }

    /**
     * @param integer $right
     */
    public function setRight($right)
    {
        $this->right = $right;
    }

    /**
     * @return integer
     */
    public function getRight()
    {
        return $this->right;
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
     * @param \Argon\GameBundle\Entity\Skill $parent
     */
    public function setParent(Skill $parent = null)
    {
        $this->parent = $parent;
    }

    /**
     * @return \Argon\GameBundle\Entity\Skill
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param \Argon\GameBundle\Entity\Skill $children
     */
    public function addChildren(Skill $children)
    {
        $this->children[] = $children;
    }

    /**
     * @param \Argon\GameBundle\Entity\Skill $children
      */
    public function removeChildren(Skill $children)
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
     * @param string $locale
     */
    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }
}