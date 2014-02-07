<?php

namespace Argon\GameBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CharacterAbilitySequenceValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        $sequence = array();

        foreach ($value as $characterAbility) {
            $modifier = $characterAbility->getModifier();

            if (is_int($modifier)) {
                $sequence[$modifier] = true;
            }
        }

        for ($i = 1; $i <= count($value); $i++) {
            if (!isset($sequence[$i]) || $sequence[$i] !== true) {
                $this->context->addViolation($constraint->message, array(
                    '%number%' => $i,
                ));
                return;
            }
        }
    }
}