<?php

namespace Argon\GameBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

use Doctrine\Common\Persistence\ObjectManager;

class CharacterSkillsEnoughExperienceValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if ($value === null) {
            return;
        }

        if (count($value) === 0) {
            return;
        }

        foreach ($value as $characterSkill) {
            if (!isset($experience)) {
                $experience = $characterSkill->getCharacter()->getAvailableExperience();
            }

            if (null === $characterSkill->getNewLevel()) {
                continue;
            }

            $cost = $characterSkill->getNewLevelCost();

            if ($experience >= $cost) {
                $experience -= $cost;
            } else {
                $this->context->addViolation($constraint->message, array(
                    '{{ skill }}'      => $characterSkill->getSkill()->getName(),
                    '{{ experience }}' => $cost - $experience,
                ));
            }
        }
    }
}