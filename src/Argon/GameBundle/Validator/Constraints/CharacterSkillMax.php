<?php

namespace Argon\GameBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class CharacterSkillMax extends Constraint
{
    public $message = '{{ skill }} level can not be greater than {{ limit }}.';

    public function validatedBy()
    {
        return 'character_skill_max';
    }
}