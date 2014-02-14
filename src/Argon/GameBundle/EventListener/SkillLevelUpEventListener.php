<?php

namespace Argon\GameBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\Common\Persistence\ObjectManager;

use Argon\GameBundle\Entity\CharacterSkill;
use Argon\GameBundle\Entity\CharacterExperience;

class SkillLevelUpEventListener
{
    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof CharacterSkill) {
            $this->levelUp($args->getEntityManager(), $entity);
        }
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof CharacterSkill) {
            $this->levelUp($args->getEntityManager(), $entity);
        }
    }

    protected function levelUp(ObjectManager $entityManager, CharacterSkill $characterSkill)
    {
        if ($characterSkill->getNewLevel() === null) {
            return;
        }

        // We don't re-validate that is possible to level up with the
        // experience the character has. We depend on the validation of the
        // entity to work.

        // Experience cost of buying the new skill.
        $value = $characterSkill->getNewLevelCost();

        // Update the Character to add more used experience in skills.
        $character = $characterSkill->getCharacter();
        $character->addSkillsExperience($value);

        // {{{ Add negative experience to the history.
        $experience = new CharacterExperience();
        $experience->setCharacter($character);
        $experience->setValue($value * -1);

        // FIXME Use translator for this text
        $experience->setReason(strtr('Level UP {{ skill }}', array(
            '{{ skill }}' => $characterSkill->getSkill(),
        )));

        $entityManager->persist($experience);
        // }}}

        // Finally, update the character's skill level.
        $characterSkill->setLevel($characterSkill->getNextLevel());
    }
}