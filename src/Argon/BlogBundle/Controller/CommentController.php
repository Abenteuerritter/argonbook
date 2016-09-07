<?php

namespace Argon\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Argon\BlogBundle\Entity\Post;
use Argon\BlogBundle\Entity\Comment;

class CommentController extends Controller
{
    public function newAction(Post $post)
    {
        $comment = new Comment($post);
        $comment->setCreator($this->getUser());
    }
}