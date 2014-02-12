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

            $this->context->validateValue($value->getNextLevel(), $range);
        }
    }
}