<?php

namespace Argon\BlogBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Argon\BlogBundle\Entity\Post;
use Argon\BlogBundle\Entity\Comment;
use Argon\BlogBundle\Form\Type\CommentDeleteType;

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

    public function deleteAction(Post $post, Comment $comment, Request $request)
    {
        if (!$post->getComments()->contains($comment)) {
            $request->getSession()->getFlashBag()
                    ->add('error', 'admin.blog.comment.belong_error');

            return $this->redirect(
                $this->generateUrl('admin_blog_view', array('slug' => $post->getSlug()))
            );
        }

        $form = $this->createForm(CommentDeleteType::class, $comment, array(
            'action' => $this->generateUrl('admin_blog_comment_delete', array(
                'slug' => $post->getSlug(),
                'id'   => $comment->getId(),
            )),
            'method' => 'POST',
        ));

        $form->add('submit', SubmitType::class, array(
            'label' => 'admin.blog.comment.delete',
            'attr'  => array('class' => 'button'),
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $request->getSession()->getFlashBag()
                    ->add('success', 'admin.blog.comment.deleted');

            return $this->redirect(
                $this->generateUrl('admin_blog_comment', array('slug' => $post->getSlug()))
            );
        }

        return $this->render('ArgonBlogBundle:Admin\Comment:delete.html.twig', array(
            'post'    => $post,
            'comment' => $comment,
            'form'    => $form->createView(),
        ));
    }
}