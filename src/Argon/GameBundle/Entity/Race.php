<?php

namespace Argon\GameBundle\Entity;

use Gedmo\Translatable\Translatable;

class Race implements Translatable
{
    /**
     * @var integer
     */
    protected $id;

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
     * @var string
     */
    protected $locale;

    public function __toString()
    {
        return $this->name;
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
     * @param string $locale
     */
    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }
}