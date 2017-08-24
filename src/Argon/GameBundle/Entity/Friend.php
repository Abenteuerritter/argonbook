<?php

namespace Argon\GameBundle\Entity;

use Argon\GameBundle\Exception\CharacterNotFriendException;

class Friend
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var \Argon\GameBundle\Entity\Character
     */
    protected $leftCharacter;

    /**
     * @var \Datetime
     */
    protected $leftCreatedAt;

    /**
     * @var \Argon\GameBundle\Entity\Character
     */
    protected $rightCharacter;

    /**
     * @var \DateTime
     */
    protected $rightAcceptedAt;

    public function __construct(Character $leftCharacter, Character $rightCharacter)
    {
        $this->leftCharacter = $leftCharacter;
        $this->leftCreatedAt = new \DateTime;
        $this->rightCharacter = $rightCharacter;
    }

    /**
     * @return \Argon\GameBundle\Entity\Character
     */
    public function getLeftCharacter()
    {
        return $this->leftCharacter;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setLeftCreatedAt(\DateTime $createdAt)
    {
        $this->leftCreatedAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getLeftCreatedAt()
    {
        return $this->leftCreatedAt;
    }

    /**
     * @return \Argon\GameBundle\Entity\Character
     */
    public function getRightCharacter()
    {
        return $this->rightCharacter;
    }

    /**
     * @param \DateTime $acceptedAt
     */
    public function setRightAcceptedAt(\DateTime $acceptedAt)
    {
        $this->rightAcceptedAt = $acceptedAt;
    }

    /**
     * @return \DateTime
     */
    public function getRightAcceptedAt()
    {
        return $this->rightAcceptedAt;
    }

    /**
     * @return boolean
     */
    public function isAccepted()
    {
        return $this->rightAcceptedAt !== null;
    }

    /**
     * Retrieves left character if right given and vice versa. Throws exception
     * if given character is not part of the friendship.
     *
     * @param Character $character
     *
     * @throws \Argon\GameBundle\Exception\CharacterNotFriendException
     * @return \Argon\GameBundle\Entity\Character
     */
    public function getFriendOf(Character $character)
    {
        if ($this->getLeftCharacter()->isEqualTo($character)) {
            return $this->getRightCharacter();
        }

        if ($this->getRightCharacter()->isEqualTo($character)) {
            return $this->getLeftCharacter();
        }

        throw new CharacterNotFriendException;
    }
}