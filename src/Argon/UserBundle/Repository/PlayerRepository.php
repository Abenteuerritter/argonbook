<?php

namespace Argon\UserBundle\Repository;

use Doctrine\ORM\EntityRepository;

class PlayerRepository extends EntityRepository
{
    /**
     * @return \Doctrine\ORM\Query
     */
    public function createQuery()
    {
        return $this->createQueryBuilder('p')->getQuery();
    }
}