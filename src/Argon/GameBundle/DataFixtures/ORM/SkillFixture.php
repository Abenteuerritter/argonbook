<?php

namespace Argon\GameBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Argon\GameBundle\Entity\Skill;

class SkillFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $manager->persist($this->createSkill('first_aid', 'First Aid'));
        $manager->flush();
    }

    protected function createSkill(
        $code, $name, $abilityCode = null, $parent = null,
        $max = null, $modifier = 1
    ) {
        $skill = new Skill();
        $skill->setAbilityCode($abilityCode);
        $skill->setCode($code);
        $skill->setName($name);
        $skill->setModifier($modifier);
        $skill->setMax($max);
        $skill->setParent($parent);

        return $skill;
    }
}