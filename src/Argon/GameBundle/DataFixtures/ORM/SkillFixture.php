<?php

namespace Argon\GameBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Argon\GameBundle\Entity\Skill;

class SkillFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $strWeaponUse = $this->createSkill($manager, 'STR', 'Weapon Use', 'Waffengebrauch');
        $strTwoWeapons = $this->createSkill($manager, 'STR', 'Two Weapons', 'Zwei Waffen', $strWeaponUse);

        $this->createSkill($manager, 'STR', 'Use Leather Armor', 'Benutzen von Lederrüstung');
        $this->createSkill($manager, 'STR', 'Use Metal Armor', 'Benutzen von Metallrüstung');
        $this->createSkill($manager, 'STR', 'Hit with Shield', 'Schildschlag');

        $strFistFight = $this->createSkill($manager, 'STR', 'Fist Fight', 'Faustkampf', null, 1, 6);

        $this->createSkill($manager, 'STR', 'Carry Person', 'Person tragen');
        $this->createSkill($manager, 'STR', 'Concentration', 'Konzentration');
        $this->createSkill($manager, 'STR', 'Two-Handed Weapon', 'Zweihand-Waffen', null, 2);
        $this->createSkill($manager, 'STR', 'Berserker', 'Berserker', $strFistFight, 2);
        $this->createSkill($manager, 'STR', 'Battle Cry', 'Kampruf', $strTwoWeapons, 2);
        $this->createSkill($manager, 'STR', 'Fortitude', 'Die Kraft', null, 2);
        $this->createSkill($manager, 'STR', 'Stamina (Extra Life Points)', 'Ausdauer (Zusätzlicher Lebenspunkt)', null, 2, 8);

        $manager->flush();
    }

    protected function createSkill(ObjectManager $manager, $ability, $name, $nameDE = null, $parent = null, $modifier = 1, $max = null)
    {
        $repository = $manager->getRepository('Gedmo\\Translatable\\Entity\\Translation');

        $skill = new Skill();
        $skill->setAbilityCode($ability);
        $skill->setName($name);
        $skill->setParent($parent);
        $skill->setModifier($modifier);
        $skill->setMax($max);

        if ($nameDE !== null) {
            $repository->translate($skill, 'name', 'de', $nameDE);
        }

        $manager->persist($skill);

        return $skill;
    }
}