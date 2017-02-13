<?php

namespace Argon\GameBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Argon\GameBundle\Entity\Race;

class RaceFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $this->createRace($manager, 'Elf',      'Elf',              ['MID']);
        $this->createRace($manager, 'High Elf', 'Hochelf',          ['MID']);
        $this->createRace($manager, 'Dark Elf', 'Dunkelelf (Drow)', ['MID']);
        $this->createRace($manager, 'Wild Elf', 'Wild-Elf',         ['MID']);
        $this->createRace($manager, 'Human',    'Mensch',           ['MID']);
        $this->createRace($manager, 'Orc',      'Orc',              ['MID']);
        $this->createRace($manager, 'Half Orc', 'Halb Orc',         ['MID']);
        $this->createRace($manager, 'Half Elf', 'Halb Elf',         ['MID']);
        $this->createRace($manager, 'Goblin',   'Kobold',           ['MID']);
        $this->createRace($manager, 'Dwarf',    'Zwerg',            ['MID']);
        $this->createRace($manager, 'Hobbit',   'Hobbit',           ['MID']);
        $this->createRace($manager, 'Fairy',    'Fee',              ['MID']);
        $this->createRace($manager, 'Gnome',    'Gnom',             ['MID']);

        $manager->flush();
    }

    protected function createRace(ObjectManager $manager, $name, $nameDE = null, array $genres = [], $modifier = 1)
    {
        /** @var \Gedmo\Translatable\Entity\Repository $repository */
        $repository = $manager->getRepository('Gedmo\\Translatable\\Entity\\Translation');

        $race = new Race();
        $race->setName($name);
        $race->setModifier($modifier);
        $race->setGenres($genres);

        if ($nameDE !== null) {
            $repository->translate($race, 'name', 'de', $nameDE);
        }

        $manager->persist($race);
    }
}