<?php

namespace Argon\GameBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraints\Range;

class CharacterSkillMaxValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if ($value === null) {
            return;
        }

        foreach ($value as $characterSkill) {
            $max = $characterSkill->getSkill()->getMax();

            if ($max !== null) {
                $range = new Range(array('max' => $max));
                $range->maxMessage = strtr($constraint->message, array(
                    '{{ skill }}' => $characterSkill->getSkill()->getName(),
                ));

                $this->context->validateValue($characterSkill->getLevel(), $range);
            }
        }
    }
}