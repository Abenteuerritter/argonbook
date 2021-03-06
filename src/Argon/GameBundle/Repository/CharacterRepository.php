<?php

namespace Argon\GameBundle\Repository;

use Doctrine\ORM\EntityRepository;

use Argon\UserBundle\Entity\Player;
use Argon\GameBundle\Provider\GameInterface;

class CharacterRepository extends EntityRepository
{
    public function findOneByPlayerAndUsername(Player $player, $username)
    {
        $builder = $this->createQueryBuilder('pj');
        $builder->where('pj.player = :player');
        $builder->andWhere('pj.slug = :username');
        $builder->setParameters(array(
            'player'   => $player,
            'username' => $username,
        ));

        return $builder->getQuery()->getOneOrNullResult();
    }

    /**
     * @return \Doctrine\ORM\Query
     */
    public function createQuery()
    {
        $builder = $this->createQueryBuilder('c');
        $builder->innerJoin('c.race', 'r')->addSelect('r');
        $builder->innerJoin('c.abilities', 'ca')->addSelect('ca');
        $builder->leftJoin('c.skills', 'cs')->addSelect('cs');

        return $builder->getQuery();
    }

    /**
     * @return \Doctrine\ORM\Query
     */
    public function createQueryByGameName($gameName)
    {
        $builder = $this->createQueryBuilder('c');
        $builder->where('c.gameName = :gameName');
        $builder->setParameters(array(
            'gameName' => $gameName,
        ));

        return $builder->getQuery();
    }

    /**
     * @return \Doctrine\ORM\Query
     */
    public function createQueryByPlayer(Player $player)
    {
        $builder = $this->createQueryBuilder('c');
        $builder->where('c.player = :player');
        $builder->setParameters(array(
            'player' => $player,
        ));

        return $builder->getQuery();
    }
}