<?php

use Argon\Entity\Blog\Post;
use Argon\EventListener\Blog\ImageUploaderListener;

$container->register('argon_blog.listener.image_uploader', [
    'class' => ImageUploaderListener::class,
    'tags' => [
        ['name' => 'doctrine.event_listener', 'entity' => Post::class, 'event' => 'postLoad'],
        ['name' => 'doctrine.event_listener', 'entity' => Post::class, 'event' => 'prePersist'],
        ['name' => 'doctrine.event_listener', 'entity' => Post::class, 'event' => 'preUpdate'],
    ],
]);
