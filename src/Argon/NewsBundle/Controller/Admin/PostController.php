<?php

namespace Argon\NewsBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Argon\NewsBundle\Entity\NewsPost;

use Argon\NewsBundle\Form\Type\PostType;
use Argon\NewsBundle\Form\Type\PostPublishType;

class PostController extends Controller
{
    public function indexAction()
    {
        $entities = $this->getRepository()->findAll();

        return $this->render('ArgonNewsBundle:Admin\Post:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    public function newAction(Request $request)
    {
        $post = new NewsPost();
        $post->setCreator($this->getUser());

        $form = $this->createForm(PostType::class, $post, array(
            'action' => $this->generateUrl('admin_news_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array(
            'label' => 'news.post.create',
        ));

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($post);
                $em->flush();

                $request->getSession()->getFlashBag()
                        ->add('success', 'news.post.created');

                return $this->redirect($this->generateUrl('admin_news'));
            }
        }

        return $this->render('ArgonNewsBundle:Admin\Post:new.html.twig', array(
            'post' => $post,
            'form' => $form->createView(),
        ));
    }

    public function viewAction(NewsPost $post)
    {
        return $this->render('ArgonNewsBundle:Admin\Post:view.html.twig', array(
            'post' => $post,
        ));
    }

    public function publishAction(NewsPost $post, Request $request)
    {
        $post->setStatus(NewsPost::STATUS_PUBLISHED);
        $form = $this->createForm(PostPublishType::class, $post, array(
            'action' => $this->generateUrl('admin_news_publish', array('slug' => $post->getSlug())),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array(
            'label' => 'news.post.publish',
        ));

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->flush();

                $request->getSession()->getFlashBag()
                        ->add('success', 'news.post.published');

                return $this->redirect($this->generateUrl('admin_news'));
            }
        }

        return $this->render('ArgonNewsBundle:Admin\Post:publish.html.twig', array(
            'post' => $post,
            'form' => $form->createView(),
        ));
    }

    public function editAction(NewsPost $post, Request $request)
    {
        $form = $this->createForm(PostType::class, $post, array(
            'action' => $this->generateUrl('admin_news_update', array('slug' => $post->getSlug())),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array(
            'label' => 'news.post.edit',
        ));

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->flush();

                $request->getSession()->getFlashBag()
                        ->add('success', 'news.post.updated');

                return $this->redirect($this->generateUrl('admin_news'));
            }
        }

        return $this->render('ArgonNewsBundle:Admin\Post:edit.html.twig', array(
            'post' => $post,
            'form' => $form->createView(),
        ));
    }

    protected function getRepository()
    {
        return $this->getDoctrine()->getRepository('ArgonNewsBundle:NewsPost');
    }
}