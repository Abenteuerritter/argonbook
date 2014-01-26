<?php

namespace Argon\CommonBundle\Entity;

use FOS\UserBundle\Model\User;

/**
 * Players of Argon
 */
class Player extends User
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

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
}