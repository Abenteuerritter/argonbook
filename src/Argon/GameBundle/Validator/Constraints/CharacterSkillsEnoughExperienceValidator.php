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

        if ($value->count() === 0) {
            return;
        }

        $experience = $value->first()->getCharacter()->getAvailableExperience();

        foreach ($value as $characterSkill) {
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