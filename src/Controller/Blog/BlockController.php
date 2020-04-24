<?php

namespace Argon\Controller\Blog;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Argon\Entity\Blog\Post;
use Argon\Entity\Blog\Comment;

class BlockController extends Controller
{
    public function latestAction()
    {
        $entities = $this->getRepository()->findLatest();

        return $this->render('blog:block:latest.html.twig', array(
            'entities' => $entities,
        ));
    }

    public function postAction(Post $post, $position = null)
    {
        return $this->render('blog:block:post.html.twig', array(
            'post'           => $post,
            'position'       => $position,
            'show_big_title' => $position === null,
            'show_links'     => $position !== null,
        ));
    }

    public function commentsAction(Post $post, $page = 1)
    {
        $pagination = $this->get('knp_paginator')->paginate($post->getComments(), $page);

        return $this->render('blog:block:comments.html.twig', array(
            'post'     => $post,
            'entities' => $pagination,
        ));
    }

    public function commentAction(Comment $comment, $position = null)
    {
        return $this->render('blog:block:comment.html.twig', array(
            'comment'  => $comment,
            'position' => $position,
        ));
    }

    /**
     * @return \Argon\Repository\Blog\PostRepository
     */
    protected function getRepository()
    {
        return $this->getDoctrine()->getRepository(Post::class);
    }
}