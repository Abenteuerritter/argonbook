<?php

namespace Argon\Controller\Blog;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Argon\Entity\Blog\Post;
use Argon\Entity\Blog\Comment;
use Argon\Form\Type\Blog\CommentType;

class PostController extends Controller
{
    public function viewAction($slug)
    {
        /** @var Post $post */
        $post = $this->getDoctrine()->getRepository(Post::class)->findOneBySlug($slug);

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

        return $this->render('blog:post:view.html.twig', array(
            'post'             => $post,
            'new_comment_form' => isset($newCommentForm) ? $newCommentForm->createView() : null,
        ));
    }
}