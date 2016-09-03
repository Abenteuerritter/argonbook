<?php

namespace Argon\UserBundle\Entity;

use FOS\UserBundle\Model\User;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;

/**
 * Players of Argon
 */
class Player extends User implements EquatableInterface
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
     * {@inheritDoc}
     * @see \Symfony\Component\Security\Core\User\EquatableInterface::isEqualTo()
     */
    public function isEqualTo(UserInterface $user)
    {
        if (!$user instanceof Player) {
            return false;
        }

        if ($user->getEmail() !== $this->getEmail()) {
            return false;
        }

        return true;
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
}