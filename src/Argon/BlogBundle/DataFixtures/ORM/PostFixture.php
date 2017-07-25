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
Hello. This is Argonbook's **first** blog post.
BODY
        );

        $manager->persist($hello);
        $manager->flush();
    }
}