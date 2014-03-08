<?php

namespace Argon\MessageBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use FOS\MessageBundle\Entity\Thread as BaseThread;

class Thread extends BaseThread
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var \Argon\GameBundle\Entity\Character
     */
    protected $createdBy;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $messages;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $metadata;
}