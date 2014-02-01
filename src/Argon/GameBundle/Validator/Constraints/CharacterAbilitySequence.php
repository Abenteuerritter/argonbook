<?php

namespace Argon\GameBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class CharacterAbilitySequence extends Constraint
{
    public $message = 'Missing number %number% from sequence.';

    public function validatedBy()
    {
        return 'character_ability_sequence';
    }
}