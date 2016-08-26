<?php

namespace Argon\GameBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Argon\GameBundle\Entity\Skill;

class SkillFixture implements FixtureInterface
{
    /**
     * @var array
     */
    protected $skills = array();

    public function load(ObjectManager $manager)
    {
        // General / Allgemein
        $this->createSkill($manager, null,  'Appraise',                    'Einschätzen',                         1,   1);
        $this->createSkill($manager, null,  'Trade',                       'Handel',                              1,   1, array('appraise'));
        $this->createSkill($manager, null,  'Firemaking',                  'Feuer machen',                        1,   1);
        $this->createSkill($manager, null,  'World Knowledge',             'Weltwissen',                          1,   1);
        $this->createSkill($manager, null,  'Survival',                    'Überleben',                           1,   1);
        $this->createSkill($manager, null,  'Handcraft-Profession',        'Handwerk-Beruf',                      1,   1);
        $this->createSkill($manager, null,  'Carpenter',                   'Tischier',                            2,   3, array('handcraft-profession'));
        $this->createSkill($manager, null,  'Blacksmith',                  'Grobschmied',                         2,   3, array('handcraft-profession'));
        $this->createSkill($manager, null,  'Jeweler',                     'Juwelier',                            2,   3, array('handcraft-profession'));
        $this->createSkill($manager, null,  'Cook',                        'Kocher',                              2,   3, array('handcraft-profession'));
        $this->createSkill($manager, null,  'Pitman',                      'Bergmann',                            2,   3, array('handcraft-profession'));
        $this->createSkill($manager, null,  'Tailor',                      'Schneider',                           2,   3, array('handcraft-profession'));
        $this->createSkill($manager, null,  'Sixth Sense',                 'Sechster Sinn',                       3,   1);
        $this->createSkill($manager, null,  'Immunity',                    'Immunität',                           3, null);
        $this->createSkill($manager, null,  'Courage',                     'Mut',                                 3,   1);
        $this->createSkill($manager, null,  'Torture',                     'Folter',                              3,   1);

        // Strength / Stärke
        $this->createSkill($manager, 'STR', 'Weapon Use',                  'Waffengebrauch',                      1,   1);
        $this->createSkill($manager, 'STR', 'Two Weapons',                 'Zwei Waffen',                         1,   1, array('weapon-use'));
        $this->createSkill($manager, 'STR', 'Use Leather Armor',           'Benutzen von Lederrüstung',           1,   1);
        $this->createSkill($manager, 'STR', 'Use Metal Armor',             'Benutzen von Metallrüstung',          1,   1);
        $this->createSkill($manager, 'STR', 'Hit with Shield',             'Schildschlag',                        1,   1);
        $this->createSkill($manager, 'STR', 'Fist Fight',                  'Faustkampf',                          1,   6);
        $this->createSkill($manager, 'STR', 'Carry Person',                'Person tragen',                       1,   1);
        $this->createSkill($manager, 'STR', 'Concentration',               'Konzentration',                       1,   1);
        $this->createSkill($manager, 'STR', 'Two-Handed Weapon',           'Zweihand-Waffen',                     2,   1);
        $this->createSkill($manager, 'STR', 'Berserker',                   'Berserker',                           2,   1, array('fist-fight'));
        $this->createSkill($manager, 'STR', 'Battle Cry',                  'Kampruf',                             2,   1, array('two-weapons'));
        $this->createSkill($manager, 'STR', 'Fortitude',                   'Die Kraft',                           2,   9);
        $this->createSkill($manager, 'STR', 'Stamina (Extra Life Points)', 'Ausdauer (Zusätzlicher Lebenspunkt)', 2,   8);

        // Dexterity / Geschicklichkeit
        $this->createSkill($manager, 'DEX', 'Throwing Weapon',             'Wurfgeschoss',                        1,   1);
        $this->createSkill($manager, 'DEX', 'Bow - Crossbow',              'Bogen - Armbrust',                    1,   1);
        $this->createSkill($manager, 'DEX', 'Stealth',                     'Verstecken im Schatten',              1,   1);
        $this->createSkill($manager, 'DEX', 'Hide-Search',                 'Entstecken-Suchen',                   1, null);
        $this->createSkill($manager, 'DEX', 'Escape Artist',               'Ausbruchsmeister',                    1,   1);
        $this->createSkill($manager, 'DEX', 'Find/Remove/Build traps',     'Fallen finden/entschärfen/bauen',     1, null);
        $this->createSkill($manager, 'DEX', 'Open/Build locks',            'Schlösser öffnen\bauen',              1, null);
        $this->createSkill($manager, 'DEX', 'Thievery',                    'Diebstahl',                           1,   1);
        $this->createSkill($manager, 'DEX', 'Pickpocketing',               'Taschendiebstahl',                    2,   9, array('thievery'));
        $this->createSkill($manager, 'DEX', 'Shoplifting',                 'Warendiebstahl',                      2,   9, array('thievery'));
        $this->createSkill($manager, 'DEX', 'Burglary',                    'Einbruch',                            2,   9, array('thievery', 'open-build-locks'));
        $this->createSkill($manager, 'DEX', 'Strangle',                    'Erwürgen',                            2,   1);
        $this->createSkill($manager, 'DEX', 'Knock unconscious',           'Niederschlagen',                      2,   1, array('strangle'));
        $this->createSkill($manager, 'DEX', 'Assasinate',                  'Meucheln',                            2,   1, array('knock-unconscious'));
        $this->createSkill($manager, 'DEX', 'The Reflex',                  'Der Reflex',                          2,   9);

        // Wisdom / Weisheit
        $this->createSkill($manager, 'WIS', 'Reading & Writing',           'Lesen und Schreiben',                 1,   1);
        $this->createSkill($manager, 'WIS', 'First Aid',                   'Erste Hilfe',                         1,   1);
        $this->createSkill($manager, 'WIS', 'Healing arts',                'Heilkunde',                           1,   9, array('first-aid'));
        $this->createSkill($manager, 'WIS', 'Tales and Legends',           'Geschichten und Legenden',            1,   2);
        $this->createSkill($manager, 'WIS', 'Extra Magic Points',          'Zusätzliche Magiepunkte',             1, null);
        $this->createSkill($manager, 'WIS', 'Magic Knowledge',             'Magie durchschauen',                  1,   1);
        $this->createSkill($manager, 'WIS', 'Magic',                       'Magie',                               1,   9, array('magic-knowledge'));
        $this->createSkill($manager, 'WIS', 'Herbalist',                   'Kreuterkenner',                       1,   1);
        $this->createSkill($manager, 'WIS', 'Alchemy',                     'Alchemie',                            2,   9, array('herbalist'));
        $this->createSkill($manager, 'WIS', 'Identify Magic Object',       'Magische Dinge erkennen',             2,   1);
        $this->createSkill($manager, 'WIS', 'Create Magic Object',         'Magische Objekt Erzeugen',            2,   9, array('handcraft-profession'));
        $this->createSkill($manager, 'WIS', 'Tracking',                    'Verfolgen',                           2,   1, array('hide-search'));
        $this->createSkill($manager, 'WIS', 'The Will',                    'Der Wille',                           2,   9);
    }

    protected function createSkill(ObjectManager $manager, $ability, $name, $nameDE = null, $modifier = 1, $max = null, $required = array())
    {
        /** @var \Gedmo\Translatable\Entity\Repository $repository */
        $repository = $manager->getRepository('Gedmo\\Translatable\\Entity\\Translation');

        $skill = new Skill();
        $skill->setAbilityCode($ability);
        $skill->setName($name);
        $skill->setModifier($modifier);
        $skill->setMax($max);

        if ($nameDE !== null) {
            $repository->translate($skill, 'name', 'de', $nameDE);
        }

        foreach ($required as $requirement) {
            $skill->addRequirement($this->skills[$requirement]);
        }

        $manager->persist($skill);
        $manager->flush();

        $this->skills[$skill->getSlug()] = $skill;
    }
}