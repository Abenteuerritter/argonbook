<?php

namespace Argon\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

use Argon\BlogBundle\Entity\Post;
use Argon\BlogBundle\Entity\Comment;
use Argon\BlogBundle\Form\Type\CommentType;

class CommentController extends Controller
{
    public function createAction(Request $request, $slug)
    {
        $this->denyAccessUnlessGranted('ROLE_PLAYER', null,
            'You must be logged as a player to add a new comment.');

        /** @var Post $post */
        $post = $this->getDoctrine()->getRepository(Post::class)->findOneBySlug($slug);

        $player  = $this->getUser();
        $comment = new Comment($post, $player);

        $form = $this->createForm(CommentType::class, $comment, array(
            'action' => $this->generateUrl('blog_comment_create', array('slug' => $post->getSlug())),
            'method' => 'POST',
        ));

        $form->add('submit', SubmitType::class, array(
            'label' => 'blog.comment.create',
            'attr'  => array('class' => 'button'),
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            $request->getSession()->getFlashBag()
                    ->add('success', 'blog.comment.created');

            return $this->redirect($this->generateUrl('blog_post', array('slug' => $post->getSlug())));
        }

        return $this->render('ArgonBlogBundle:Comment:new.html.twig', array(
            'post'    => $post,
            'comment' => $comment,
            'form'    => $form->createView(),
        ));
    }
}