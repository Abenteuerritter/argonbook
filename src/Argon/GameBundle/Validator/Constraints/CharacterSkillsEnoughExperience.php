<?php

namespace Argon\GameBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class CharacterSkillsEnoughExperience extends Constraint
{
    public $message = 'You do not have enough experience to adquire {{ skill }}. You need {{ experience }} XP more.';

    public function validatedBy()
    {
        return 'character_skills_enough_experience';
    }
}