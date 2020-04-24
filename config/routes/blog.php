<?php

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

use Argon\Controller\Blog\PostController;
use Argon\Controller\Blog\CommentController;

return function(RoutingConfigurator $routes) {
    $routes
        ->add('blog_post', '/blog/{slug}')
        ->controller([PostController::class, 'view'])
        ->methods(['GET'])
    ;
    $routes
        ->add('blog_comment_create', '/blog/{slug}/comment')
        ->controller([CommentController::class, 'create'])
        ->methods(['GET', 'POST'])
    ;
};