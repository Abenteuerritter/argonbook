<?php

namespace Argon\GameBundle\Security;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Role\SwitchUserRole;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\SecurityContext;

use Doctrine\Common\Persistence\ObjectManager;

use Argon\CommonBundle\Entity\Player;

class CharacterProvider implements UserProviderInterface
{
    /**
     * @var \Doctrine\Common\Persistence\ObjectManager
     */
    protected $entityManager;

    /**
     * @var \Symfony\Component\Security\Core\SecurityContext
     */
    protected $securityContext;

    /**
     * @param \Doctrine\Common\Persistence\ObjectManager       $entityManager
     * @param \Symfony\Component\Security\Core\SecurityContext $securityContext
     */
    public function __construct(ObjectManager $entityManager, SecurityContext $securityContext)
    {
        $this->entityManager = $entityManager;
        $this->securityContext = $securityContext;
    }

    /**
     * (non-PHPdoc)
     * @see \Symfony\Component\Security\Core\User\UserProviderInterface::loadUserByUsername()
     */
    public function loadUserByUsername($username)
    {
//         if ($this->securityContext->isGranted('ROLE_PREVIOUS_ADMIN')) {
//             foreach ($this->securityContext->getToken()->getRoles() as $role) {
//                 if ($role instanceof SwitchUserRole) {
//                     $player = $role->getSource()->getUser();
//                 }
//             }
//         } else {
//             $player = $this->securityContext->getToken()->getUser();
//         }

        $player = $this->securityContext->getToken()->getUser();

        if (!$player instanceof Player) {
            throw new UnsupportedUserException(
                'Only a player can switch to a chracter.'
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
     * (non-PHPdoc)
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
     * (non-PHPdoc)
     * @see \Symfony\Component\Security\Core\User\UserProviderInterface::supportsClass()
     */
    public function supportsClass($class)
    {
        return $class === 'Argon\\GameBundle\\Entity\\Character';
    }
}