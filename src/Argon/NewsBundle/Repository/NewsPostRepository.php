<?php

namespace Argon\NewsBundle\Repository;

use Doctrine\ORM\EntityRepository;

class NewsPostRepository extends EntityRepository
{
    public function findLatest($limit = 5)
    {
        return $this
            ->createQueryBuilder('np')
            ->addSelect('c')
            ->innerJoin('np.creator', 'c')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
        ;
    }
}