<?php

namespace Argon\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Argon\BlogBundle\Entity\Post;

class PostController extends Controller
{
    public function viewAction(Post $post)
    {
        return $this->render('ArgonBlogBundle:Post:view.html.twig', array(
            'post' => $post,
        ));
    }
}