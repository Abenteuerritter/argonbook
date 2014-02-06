<?php

namespace Argon\GameBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Argon\GameBundle\Entity\Skill;

class SkillFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Strength / Stärke
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

        // Dexterity / Geschicklichkeit
        $this->createSkill($manager, 'DEX', 'Throwing Weapon', 'Wurfgeschoss');
        $this->createSkill($manager, 'DEX', 'Bow - Crossbow', 'Bogen - Armbrust');
        $this->createSkill($manager, 'DEX', 'Stealth', 'Verstecken im Schatten');

        $dexHideSearch = $this->createSkill($manager, 'DEX', 'Hide-Search', 'Entstecken-Suchen');

        $this->createSkill($manager, 'DEX', 'Escape Artist', 'Ausbruchsmeister');
        $this->createSkill($manager, 'DEX', 'Find/Remove/Build traps', 'Fallen finden/entschärfen/bauen');
        $this->createSkill($manager, 'DEX', 'Open/Build locks', 'Schlösser öffnen\bauen');

        $dexThievery = $this->createSkill($manager, 'DEX', 'Thievery', 'Diebstahl');

        $this->createSkill($manager, 'DEX', 'Pickpocketing', 'Taschendiebstahl', $dexThievery, 2);
        $this->createSkill($manager, 'DEX', 'Shoplifting', 'Warendiebstahl', $dexThievery, 2);
        $this->createSkill($manager, 'DEX', 'Burglary', 'Einbruch', $dexThievery, 2);

        $dexStrangle = $this->createSkill($manager, 'DEX', 'Strangle', 'Erwürgen', null, 2);
        $dexKnockUnconscious = $this->createSkill($manager, 'DEX', 'Knock unconscious', 'Niederschlagen', $dexStrangle, 2);

        $this->createSkill($manager, 'DEX', 'Assasinate', 'Meucheln', $dexKnockUnconscious, 2);
        $this->createSkill($manager, 'DEX', 'The Reflex', 'Der Reflex', null, 2);

        // Wisdom / Weisheit
        $this->createSkill($manager, 'WIS', 'Reading & Writing', 'Lesen und Schreiben');

        $wisFirstAid = $this->createSkill($manager, 'WIS', 'First Aid', 'Erste Hilfe');

        $this->createSkill($manager, 'WIS', 'Healing arts', 'Heilkunde', $wisFirstAid, 1, 9);
        $this->createSkill($manager, 'WIS', 'Tales and Legends', 'Geschichten und Legenden', null, 1, 2);
        $this->createSkill($manager, 'WIS', 'Extra Magic Points', 'Zusätzliche Magiepunkte');

        $wisMagicKnowledge = $this->createSkill($manager, 'WIS', 'Magic Knowledge', 'Magie durchschauen');

        $this->createSkill($manager, 'WIS', 'Magic', 'Magie', $wisMagicKnowledge);

        $wisHerbalist = $this->createSkill($manager, 'WIS', 'Herbalist', 'Kreuterkenner');

        $this->createSkill($manager, 'WIS', 'Alchemy', 'Alchemie', $wisHerbalist, 2);
        $this->createSkill($manager, 'WIS', 'Identify Magic Object', 'Magische Dinge erkennen', null, 2);
        $this->createSkill($manager, 'WIS', 'Create Magic Object', 'Magische Objekt Erzeugen', null, 2); // TODO requieres adecuates Handcraft
        $this->createSkill($manager, 'WIS', 'Tracking', 'Verfolgen', $dexHideSearch, 2);
        $this->createSkill($manager, 'WIS', 'The Will', 'Der Wille', null, 2);

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