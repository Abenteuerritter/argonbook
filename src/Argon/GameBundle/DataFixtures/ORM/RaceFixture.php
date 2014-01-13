<?php

namespace Argon\GameBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Argon\GameBundle\Entity\Race;

class RaceFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $elf = $this->createRace('elf', 'Elf', 10);

        $manager->persist($elf);
        $manager->persist($this->createRace('highelf', 'High Elf', 10, $elf));
        $manager->persist($this->createRace('darkelf', 'Dark Elf', 10, $elf));
        $manager->persist($this->createRace('wildelf', 'Wild Elf', 10, $elf));
        $manager->persist($this->createRace('human', 'Human', 10));
        $manager->persist($this->createRace('orc', 'Orc', 10));
        $manager->persist($this->createRace('halorc', 'Half Orc', 10));
        $manager->persist($this->createRace('halfelf', 'Half Elf', 10));
        $manager->persist($this->createRace('goblin', 'Goblin', 10));
        $manager->persist($this->createRace('dwarf', 'Dwarf', 10));
        $manager->persist($this->createRace('hobbit', 'Hobbit', 10));
        $manager->flush();
    }

    protected function createRace($code, $name, $multiplier, $parent = null)
    {
        $race = new Race();
        $race->setCode($code);
        $race->setName($name);
        $race->setMultiplier($multiplier);
        $race->setParent($parent);

        return $race;
    }
}