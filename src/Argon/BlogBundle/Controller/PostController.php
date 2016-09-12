<?php

namespace Argon\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Argon\BlogBundle\Entity\Post;
use Argon\BlogBundle\Entity\Comment;
use Argon\BlogBundle\Form\Type\CommentType;

class PostController extends Controller
{
    public function viewAction(Post $post)
    {
        if ($this->isGranted('ROLE_PLAYER')) {
            $player  = $this->getUser();
            $comment = new Comment($post, $player);

            $newCommentForm = $this->createForm(CommentType::class, $comment, array(
                'action' => $this->generateUrl('blog_comment_create', array('slug' => $post->getSlug())),
                'method' => 'POST',
            ));

            $newCommentForm->add('submit', SubmitType::class, array(
                'label' => 'blog.comment.create',
                'attr'  => array('class' => 'button'),
            ));
        }

        return $this->render('ArgonBlogBundle:Post:view.html.twig', array(
            'post'             => $post,
            'new_comment_form' => isset($newCommentForm) ? $newCommentForm->createView() : null,
        ));
    }
}