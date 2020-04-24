<?php

namespace Argon\Entity\Blog;

use Symfony\Component\Validator\Mapping\ClassMetadata as ValidatorMetadata;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\ClassMetadata as DoctrineMetadata;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder as DoctrineClassMetadataBuilder;

use Argon\Entity\Blog\Post;
use Argon\Entity\User\Player as Creator;

class Comment
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var \Argon\Entity\Blog\Post
     */
    protected $post;

    /**
     * @var \Argon\Entity\User\Player
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

    public static function loadMetadata(DoctrineMetadata $metadata)
    {
        $builder = new DoctrineClassMetadataBuilder($metadata);
    }

    public static function loadValidatorMetadata(ValidatorMetadata $metadata)
    {
        $metadata->addPropertyConstraints('post', [
            new Assert\NotNull(),
            new Assert\Valid(),
        ]);

        $metadata->addPropertyConstraints('creator', [
            new Assert\NotNull(),
            new Assert\Valid(),
        ]);

        $metadata->addPropertyConstraint('body', new Assert\NotBlank());
    }

    public function __toString()
    {
        return $this->getBody();
    }

    /**
     * @param \Argon\Entity\Blog\Post   $post
     * @param \Argon\Entity\User\Player $creator
     */
    public function __construct(Post $post, Creator $creator)
    {
        $this->post = $post;
        $this->creator = $creator;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \Argon\Entity\Blog\Post
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @return \Argon\Entity\User\Player
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