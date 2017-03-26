<?php

namespace Argon\GameBundle\Repository;

use Doctrine\ORM\EntityRepository;

use Argon\GameBundle\Provider\GameInterface;

class SkillRepository extends EntityRepository
{
    public function findAllByGame(GameInterface $game)
    {
        $builder = $this->createQueryBuilder('s');
        $builder->where($builder->expr()->in('s.abilityCode', ':abilities'));
        $builder->setParameters(array(
            'abilities' => array_map('strtoupper', $game->getAbilities()),
        ));

        return $builder->getQuery()->getResult();
    }
}