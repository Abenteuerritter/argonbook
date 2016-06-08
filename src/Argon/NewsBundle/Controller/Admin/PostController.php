<?php

namespace Argon\NewsBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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

        $form->add('submit', SubmitType::class, array(
            'label' => 'admin.news.create',
            'attr'  => array('class' => 'button'),
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            $request->getSession()->getFlashBag()
                    ->add('success', 'admin.news.created');

            return $this->redirect($this->generateUrl('admin_news'));
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

        $form->add('submit', SubmitType::class, array(
            'label' => 'admin.news.publish',
            'attr'  => array('class' => 'button'),
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $request->getSession()->getFlashBag()
                    ->add('success', 'admin.news.published');

            return $this->redirect($this->generateUrl('admin_news'));
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

        $form->add('submit', SubmitType::class, array(
            'label' => 'admin.news.edit_submit',
            'attr'  => array('class' => 'button'),
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $request->getSession()->getFlashBag()
                    ->add('success', 'admin.news.updated');

            return $this->redirect($this->generateUrl('admin_news'));
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