<?php

namespace Argon\GameBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;

use Argon\GameBundle\Entity\CharacterSkill;
use Argon\GameBundle\Entity\CharacterExperience;

class SkillLevelUpEventListener
{
    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof CharacterSkill) {
            $this->levelUp($entity);
        }
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof CharacterSkill) {
            $this->levelUp($entity);
        }
    }

    protected function levelUp(CharacterSkill $characterSkill)
    {
        if ($characterSkill->getNewLevel() === null) {
            return;
        }

        // We don't re-validate that is possible to level up with the
        // experience the character has. We depend on the validation of the
        // entity to work.

        // Update the Character to add more used experience in skills.
        $character = $characterSkill->getCharacter();
        $character->addSkillsExperience($characterSkill->getNewLevelCost());

        // Finally, update the character's skill level.
        $characterSkill->setLevel($characterSkill->getNextLevel());
    }
}