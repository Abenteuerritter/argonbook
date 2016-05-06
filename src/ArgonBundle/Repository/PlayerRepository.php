<?php

namespace ArgonBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class PlayerRepository extends EntityRepository
{
    /**
     * @var integer
     */
    const PER_PAGE = 10;

    /**
     * Retrieve a list of Player on the given page.
     *
     * @param integer $page
     * @param integer $perPage
     *
     * @return array
     */
    public function findByPage($page, $perPage = self::PER_PAGE)
    {
        $query = $this->createQueryBuilder('p')
            ->setFirstResult(($page - 1) * $perPage)
            ->setMaxResults($perPage)
            ->getQuery();

        return new Paginator($query, $fetchJoinCollection = true);
    }
}
