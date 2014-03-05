<?php

namespace Argon\NewsBundle\Entity;

use Argon\CommonBundle\Entity\Player as Creator;

class NewsPost
{
    const STATUS_DRAFT     = 0;
    const STATUS_PUBLISHED = 1;

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var \Argon\CommonBundle\Entity\Player
     */
    protected $creator;

    /**
     * @var integer
     */
    protected $status = self::STATUS_DRAFT;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $body;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $modifiedAt;

    /**
     * @var \DateTime
     */
    protected $publishedAt;

    /**
     * @var string
     */
    protected $locale;

    public function __toString()
    {
        return $this->getTitle();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Argon\CommonBundle\Entity\Player $creator
     */
    public function setCreator(Creator $creator)
    {
        $this->creator = $creator;
    }

    /**
     * @return \Argon\CommonBundle\Entity\Player
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * @param integer $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getModifiedAt()
    {
        return $this->modifiedAt;
    }

    /**
     * @return \DateTime
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * @param string $locale
     */
    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * @return boolean
     */
    public function isPublished()
    {
        return $this->getStatus() === self::STATUS_PUBLISHED;
    }
}