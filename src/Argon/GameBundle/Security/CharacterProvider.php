<?php

namespace Argon\GameBundle\Security;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

use Doctrine\Common\Persistence\ObjectManager;

use Argon\UserBundle\Entity\Player;

class CharacterProvider implements UserProviderInterface
{
    /**
     * @var \Doctrine\Common\Persistence\ObjectManager
     */
    protected $entityManager;

    /**
     * @var \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface
     */
    protected $tokenStorage;

    /**
     * @param \Doctrine\Common\Persistence\ObjectManager                                          $entityManager
     * @param \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface $tokenStorage
     */
    public function __construct(ObjectManager $entityManager, TokenStorageInterface $tokenStorage)
    {
        $this->entityManager = $entityManager;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Security\Core\User\UserProviderInterface::loadUserByUsername()
     */
    public function loadUserByUsername($username)
    {
        $player = $this->tokenStorage->getToken()->getUser();

        if (!$player instanceof Player) {
            throw new UnsupportedUserException(
                'Only a player can switch to a character.'
            );
        }

        $character = $this->entityManager
                          ->getRepository('ArgonGameBundle:Character')
                          ->findOneByPlayerAndUsername($player, $username);

        if (null === $character) {
            throw new UsernameNotFoundException(
                sprintf('Character "%s" for player "%s" does not exist.', $username, $player->getUsername())
            );
        }

        return $character;
    }

    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Security\Core\User\UserProviderInterface::refreshUser()
     */
    public function refreshUser(UserInterface $user)
    {
        if (!$this->supportsClass(get_class($user))) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $user;
    }

    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Security\Core\User\UserProviderInterface::supportsClass()
     */
    public function supportsClass($class)
    {
        return $class === 'Argon\\GameBundle\\Entity\\Character';
    }
}