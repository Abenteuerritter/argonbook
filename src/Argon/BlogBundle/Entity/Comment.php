<?php

namespace Argon\BlogBundle\Entity;

use Argon\UserBundle\Entity\Player as Creator;

class Comment
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var \Argon\BlogBundle\Entity\Post
     */
    protected $post;

    /**
     * @var \Argon\UserBundle\Entity\Player
     */
    protected $creator;

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

    public function __toString()
    {
        return $this->getBody();
    }

    /**
     * @param \Argon\BlogBundle\Entity\Post $post
     */
    public function __consutrct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \Argon\BlogBundle\Entity\Post
     */
    public function getPost()
    {
        return $this->post;
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
}