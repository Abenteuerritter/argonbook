<?php

namespace Argon\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Argon\BlogBundle\Entity\Post;
use Argon\BlogBundle\Entity\Comment;

class BlockController extends Controller
{
    public function latestAction()
    {
        $entities = $this->getRepository()->findLatest();

        return $this->render('ArgonBlogBundle:Block:latest.html.twig', array(
            'entities' => $entities,
        ));
    }

    public function postAction(Post $post, $position = null)
    {
        return $this->render('ArgonBlogBundle:Block:post.html.twig', array(
            'post'           => $post,
            'position'       => $position,
            'show_big_title' => $position === null,
            'show_links'     => $position !== null,
        ));
    }

    public function commentsAction(Post $post, $page = 1)
    {
        $pagination = $this->get('knp_paginator')->paginate($post->getComments(), $page);

        return $this->render('ArgonBlogBundle:Block:comments.html.twig', array(
            'post'     => $post,
            'entities' => $pagination,
        ));
    }

    public function commentAction(Comment $comment, $position = null)
    {
        return $this->render('ArgonBlogBundle:Block:comment.html.twig', array(
            'comment'  => $comment,
            'position' => $position,
        ));
    }

    /**
     * @return \Argon\BlogBundle\Repository\PostRepository
     */
    protected function getRepository()
    {
        return $this->getDoctrine()->getRepository('ArgonBlogBundle:Post');
    }
}