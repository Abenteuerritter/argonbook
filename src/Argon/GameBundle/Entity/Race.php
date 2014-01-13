<?php

namespace Argon\GameBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Race
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
     * @var \Argon\GameBundle\Entity\Race
     */
    protected $parent;

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
    protected $multiplier;

    public function __construct()
    {
        $this->children = new ArrayCollection();
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
     * @param integer $multiplier
     */
    public function setMultiplier($multiplier)
    {
        $this->multiplier = $multiplier;
    }

    /**
     * @return integer
     */
    public function getMultiplier()
    {
        return $this->multiplier;
    }
}