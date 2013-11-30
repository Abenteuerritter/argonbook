<?php

namespace Argon\CommonBundle\Entity;

use FOS\UserBundle\Model\User;

/**
 * Players of Argon
 */
class Player extends User
{
    protected $id;

    protected $name;
}