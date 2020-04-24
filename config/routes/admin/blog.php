<?php

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

use Argon\Controller\Admin\Blog\PostController;
use Argon\Controller\Admin\Blog\CommentController;

return function(RoutingConfigurator $routes) {
    $routes
        ->add('admin_blog', '/blog')
        ->controller([PostController::class, 'index'])
        ->methods(['GET'])
    ;
    $routes
        ->add('admin_blog_new', '/blog/new')
        ->controller([PostController::class, 'new'])
        ->methods(['GET'])
    ;
    $routes
        ->add('admin_blog_create', '/blog/create')
        ->controller([PostController::class, 'new'])
        ->methods(['POST'])
    ;
    $routes
        ->add('admin_blog_view', '/blog/{slug}')
        ->controller([PostController::class, 'view'])
        ->methods(['GET'])
    ;
    $routes
        ->add('admin_blog_publish', '/blog/{slug}/publish')
        ->controller([PostController::class, 'publish'])
        ->methods(['GET', 'POST'])
    ;
    $routes
        ->add('admin_blog_edit', '/blog/{slug}/edit')
        ->controller([PostController::class, 'edit'])
        ->methods(['GET'])
    ;
    $routes
        ->add('admin_blog_update', '/blog/{slug}/update')
        ->controller([PostController::class, 'update'])
        ->methods(['POST'])
    ;

    $routes
        ->add('admin_blog_comment', '/blog/{slug}/comments')
        ->controller([CommentController::class, 'index'])
        ->methods(['GET'])
    ;
    $routes
        ->add('admin_blog_comment_delete', '/blog/{slug}/comment/{comment}/delete')
        ->controller([CommentController::class, 'delete'])
        ->methods(['GET', 'POST'])
    ;
};