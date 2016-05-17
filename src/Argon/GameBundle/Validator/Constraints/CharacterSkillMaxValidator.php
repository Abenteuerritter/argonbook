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

        $max = $value->getSkill()->getMax();

        if ($max !== null) {
            $range = new Range(array('max' => $max));
            $range->maxMessage = strtr($constraint->message, array(
                '{{ skill }}' => $value->getSkill()->getName(),
            ));

            $violations = $this->context->getValidator()->validate($value->getNextLevel(), $range);
            if (count($violations) > 0) {
                return $violations;
            }
        }
    }
}