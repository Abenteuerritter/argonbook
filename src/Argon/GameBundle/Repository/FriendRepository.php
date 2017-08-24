<?php

namespace Argon\GameBundle\Repository;

use Doctrine\ORM\EntityRepository;

use Argon\GameBundle\Entity\Character;

class FriendRepository extends EntityRepository
{
    public function findAcceptedByCharacter(Character $character)
    {
        return $this->createQueryBuilder('fl')
                    ->where('fl.leftCharacter = :character OR fl.rightCharacter = :character')
                    ->andWhere('fl.rightAcceptedAt IS NOT NULL')
                    ->orderBy('fl.rightAcceptedAt', 'DESC')
                    ->setParameter('character', $character)
                    ->getQuery()
                    ->getResult();
    }

    public function findPendingByCharacter(Character $character)
    {
        return $this->createQueryBuilder('fl')
                    ->where('fl.rightCharacter = :character')
                    ->andWhere('fl.rightAcceptedAt IS NULL')
                    ->orderBy('fl.leftCreatedAt', 'DESC')
                    ->setParameter('character', $character)
                    ->getQuery()
                    ->getResult();
    }

    public function findRelationBetween(Character $one, Character $two)
    {
        return $this->createQueryBuilder('fl')
                    ->where('fl.leftCharacter = :one AND fl.rightCharacter = :two')
                    ->orWhere('fl.leftCharacter = :two AND fl.rightCharacter = :one')
                    ->setParameters(array(
                        'one' => $one,
                        'two' => $two,
                    ))
                    ->getQuery()
                    ->getOneOrNullResult();
    }
}