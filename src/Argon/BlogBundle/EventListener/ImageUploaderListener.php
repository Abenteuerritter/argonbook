<?php

namespace Argon\BlogBundle\EventListener;

use Symfony\Component\HttpFoundation\File\File as Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

use Argon\BlogBundle\Entity\Post;

class ImageUploaderListener
{
    /**
     * @var string
     */
    protected $targetDir;

    /**
     * @var array|string[]
     */
    protected $allowedExtensions = ['png', 'jpg', 'jpeg', 'gif'/* deal with it*/];

    public function __construct()
    {
        $this->targetDir = __DIR__ . '/../../../../web/uploads/blog';
    }

    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Post) {
            foreach ($this->allowedExtensions as $ext) {
                if (is_readable($this->targetDir . '/' . $entity->getSlug() . '.' . $ext)) {
                    $entity->setImage(new Image($this->targetDir . '/' . $entity->getSlug() . '.' . $ext));
                }
            }
        }
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Post) {
            $this->uploadPostImage($entity);
        }
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Post) {
            $this->uploadPostImage($entity);
        }
    }

    protected function uploadPostImage(Post $post)
    {
        $image = $post->getImage();

        if (!$image instanceof UploadedFile) {
            return;
        }

        $image->move($this->targetDir, $post->getSlug() . '.' . $image->guessExtension());
    }
}