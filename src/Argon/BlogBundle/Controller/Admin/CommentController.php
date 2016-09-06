<?php

namespace Argon\BlogBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Argon\BlogBundle\Entity\Post;

class CommentController extends Controller
{
    public function indexAction(Post $post, Request $request)
    {
        $pagination = $this->get('knp_paginator')->paginate($post->getComments(),
            $request->query->getInt('page', 1)
        );

        return $this->render('ArgonBlogBundle:Admin\Comment:index.html.twig', array(
            'post'     => $post,
            'entities' => $pagination,
        ));
    }
}