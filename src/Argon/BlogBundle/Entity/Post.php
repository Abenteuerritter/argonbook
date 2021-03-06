<?php

namespace Argon\BlogBundle\Entity;

use Symfony\Component\HttpFoundation\File\File as Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use Doctrine\Common\Collections\ArrayCollection;

use Argon\UserBundle\Entity\Player as Creator;

class Post
{
    const STATUS_DRAFT     = 0;
    const STATUS_PUBLISHED = 1;

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var \Argon\UserBundle\Entity\Player
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
     * @var \Symfony\Component\HttpFoundation\File\File
     */
    protected $image;

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

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $comments;

    public function __toString()
    {
        return $this->getTitle();
    }

    public function __construct()
    {
        $this->comments = new ArrayCollection;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Argon\UserBundle\Entity\Player $creator
     */
    public function setCreator(Creator $creator)
    {
        $this->creator = $creator;
    }

    /**
     * @return \Argon\UserBundle\Entity\Player
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
     * @return string|null
     */
    public function getImagePath()
    {
        if ($this->image instanceof UploadedFile) {
            return null; // TODO image preview
            return $this->image->__toString();
        }

        if ($this->image instanceof Image) {
            return 'uploads/blog/' . $this->image->getBasename();
        }
    }

    /**
     * @param \Symfony\Component\HttpFoundation\File\File|null $image
     */
    public function setImage(Image $image = null)
    {
        if ($image) {
            $this->image = $image;
        }
    }

    /**
     * @return \Symfony\Component\HttpFoundation\File\File
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Mark post as modified.
     */
    public function setModified()
    {
        $this->modifiedAt = new \DateTime;
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

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }
}