<?php

namespace Argon\GameBundle\Repository;

use Doctrine\ORM\EntityRepository;

use Argon\CommonBundle\Entity\Player;

class CharacterRepository extends EntityRepository
{
    public function findOneByPlayerAndUsername(Player $player, $username)
    {
        return $this
            ->createQueryBuilder('pj')
            ->where('pj.player = :player')
            ->andWhere('pj.slug = :username')
            ->setParameters(array(
                'player'   => $player,
                'username' => $username,
            ))
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    /**
     * @return \Doctrine\ORM\Query
     */
    public function createQuery()
    {
        return $this->createQueryBuilder('c')->getQuery();
    }

    /**
     * @return \Doctrine\ORM\Query
     */
    public function createQueryByGameName($gameName)
    {
        return $this->createQueryBuilder('c')
                    ->where('c.gameName = :gameName')
                    ->setParameters(array(
                        'gameName' => $gameName,
                    ))
                    ->getQuery();
    }
}