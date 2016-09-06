<?php

namespace Argon\BlogBundle\EventListener;

use Symfony\Component\HttpFoundation\File\UploadedFile;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

use Argon\BlogBundle\Entity\Post;

class ImageUploaderListener
{
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

        if ($image instanceof UploadedFile) {
            $image->move(__DIR__ . '/../../../../web/uploads/blog', $post->getSlug() . '.' . $image->guessExtension());
        }
    }
}