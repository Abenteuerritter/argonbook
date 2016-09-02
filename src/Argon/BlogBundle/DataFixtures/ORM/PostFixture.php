<?php

namespace Argon\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Argon\BlogBundle\Entity\Post;

class PostFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $root = $manager->getRepository('ArgonUserBundle:Player')->findOneByUsername('root');

        $hello = new Post();
        $hello->setCreator($root);
        $hello->setTitle('Hello World');
        $hello->setBody(<<<BODY
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a lacus justo.
Quisque a risus rhoncus, facilisis urna vel, varius purus. Sed pellentesque ex
volutpat, maximus ligula sed, vulputate lectus. Nunc dictum aliquam magna non
iaculis. Curabitur posuere maximus tempus. Praesent rhoncus diam orci, sit
amet bibendum lorem volutpat et. Suspendisse aliquet risus et est accumsan, a
pharetra sapien volutpat. Proin iaculis varius justo, fermentum lacinia metus
elementum et.
BODY
        );

        $manager->persist($hello);
        $manager->flush();
    }
}