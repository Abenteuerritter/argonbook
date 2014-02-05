<?php

namespace Argon\GameBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Argon\GameBundle\Entity\Race;

class RaceFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $manager->persist($this->createRace('elf', 'Elf'));
        $manager->persist($this->createRace('highelf', 'High Elf'));
        $manager->persist($this->createRace('darkelf', 'Dark Elf'));
        $manager->persist($this->createRace('wildelf', 'Wild Elf'));
        $manager->persist($this->createRace('human', 'Human'));
        $manager->persist($this->createRace('orc', 'Orc'));
        $manager->persist($this->createRace('halorc', 'Half Orc'));
        $manager->persist($this->createRace('halfelf', 'Half Elf'));
        $manager->persist($this->createRace('goblin', 'Goblin'));
        $manager->persist($this->createRace('dwarf', 'Dwarf'));
        $manager->persist($this->createRace('hobbit', 'Hobbit'));
        $manager->flush();
    }

    protected function createRace($code, $name, $modifier = 1)
    {
        $race = new Race();
        $race->setCode($code);
        $race->setName($name);
        $race->setModifier($modifier);

        return $race;
    }
}