<?php

namespace ArgonBundle\Entity;

use FOS\UserBundle\Model\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ArgonBundle\Repository\PlayerRepository")
 * @ORM\Table(name="player")
 */
class Player extends User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
    }
}
