<?php

namespace Argon\UserBundle\DataFixtures\ORM;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PlayerFixture implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var \FOS\UserBundle\Util\UserManipulator
     */
    private $userManipulator;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->userManipulator = $container->get('fos_user.util.user_manipulator');
    }

    public function load(ObjectManager $manager)
    {
        $this->userManipulator->create('root', 'pass', 'root@localhost', true, true);
        $manager->flush();
    }
}