<?php

namespace Argon\DataFixtures\ORM\Blog;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Argon\Entity\Blog\Post;
use Argon\Entity\User\Player;

class PostFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $root = $manager->getRepository(Player::class)->findOneByUsername('root');

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