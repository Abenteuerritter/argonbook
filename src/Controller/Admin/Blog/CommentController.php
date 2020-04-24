<?php

namespace Argon\Controller\Admin\Blog;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Argon\Entity\Blog\Post;
use Argon\Entity\Blog\Comment;
use Argon\Form\Type\Blog\CommentDeleteType;

class CommentController extends Controller
{
    public function indexAction(Request $request, $slug)
    {
        /** @var Post $post */
        $post = $this->getDoctrine()->getRepository(Post::class)->findOneBySlug($slug);

        $pagination = $this->get('knp_paginator')->paginate($post->getComments(),
            $request->query->getInt('page', 1)
        );

        return $this->render('admin:blog:comment:index.html.twig', array(
            'post'     => $post,
            'entities' => $pagination,
        ));
    }

    public function deleteAction(Request $request, $slug, $comment)
    {
        /** @var Post $post */
        $post = $this->getDoctrine()->getRepository(Post::class)->findOneBySlug($slug);

        /** @var Comment $comment */
        $comment = $this->getDoctrine()->getRepository(Comment::class)->findOneById($comment);

        if (!$post->getComments()->contains($comment)) {
            $request->getSession()->getFlashBag()
                    ->add('error', 'admin.blog.comment.belong_error');

            return $this->redirect(
                $this->generateUrl('admin_blog_view', array('slug' => $post->getSlug()))
            );
        }

        $form = $this->createForm(CommentDeleteType::class, $comment, array(
            'action' => $this->generateUrl('admin_blog_comment_delete', array(
                'slug'    => $post->getSlug(),
                'comment' => $comment->getId(),
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

        return $this->render('admin:blog:comment:delete.html.twig', array(
            'post'    => $post,
            'comment' => $comment,
            'form'    => $form->createView(),
        ));
    }
}