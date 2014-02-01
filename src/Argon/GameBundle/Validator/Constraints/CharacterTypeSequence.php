<?php

namespace Argon\GameBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @ Annotation
 */
class CharacterTypeSequence extends Constraint
{
    public $message = 'Missing number %number% from sequence.';

    public function validatedBy()
    {
        return 'character_type_sequence';
    }
}