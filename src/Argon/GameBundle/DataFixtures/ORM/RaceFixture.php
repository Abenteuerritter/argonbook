<?php

namespace Argon\GameBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Argon\GameBundle\Entity\Race;

class RaceFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $this->createRace($manager, 'Elf', 'Elf');
        $this->createRace($manager, 'High Elf', 'Hochelf');
        $this->createRace($manager, 'Dark Elf', 'Dunkelelf (Drow)');
        $this->createRace($manager, 'Wild Elf', 'Wild-Elf');
        $this->createRace($manager, 'Human', 'Mensch');
        $this->createRace($manager, 'Orc', 'Orc');
        $this->createRace($manager, 'Half Orc', 'Halb Orc');
        $this->createRace($manager, 'Half Elf', 'Halb Elf');
        $this->createRace($manager, 'Goblin', 'Kobold');
        $this->createRace($manager, 'Dwarf', 'Zwerg');
        $this->createRace($manager, 'Hobbit', 'Hobbit');
        $this->createRace($manager, 'Fairy', 'Fee');
        $this->createRace($manager, 'Gnome', 'Gnom');
        $manager->flush();
    }

    protected function createRace(ObjectManager $manager, $name, $nameDE = null, $modifier = 1)
    {
        /** @var \Gedmo\Translatable\Entity\Repository $repository */
        $repository = $manager->getRepository('Gedmo\\Translatable\\Entity\\Translation');

        $race = new Race();
        $race->setName($name);
        $race->setModifier($modifier);

        if ($nameDE !== null) {
            $repository->translate($race, 'name', 'de', $nameDE);
        }

        $manager->persist($race);
    }
}