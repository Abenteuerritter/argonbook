<?php

namespace Argon\MessageBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use FOS\MessageBundle\Entity\ThreadMetadata as BaseThreadMetadata;

class ThreadMetadata extends BaseThreadMetadata
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var \FOS\MessageBundle\Model\ThreadInterface
     */
    protected $thread;

    /**
     * @var \FOS\MessageBundle\Model\ParticipantInterface
     */
    protected $participant;
}