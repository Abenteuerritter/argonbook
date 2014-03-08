<?php

namespace Argon\MessageBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use FOS\MessageBundle\Entity\Message as BaseMessage;

class Message extends BaseMessage
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
    protected $sender;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $metadata;
}