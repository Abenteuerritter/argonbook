<?php

namespace Argon\NewsBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Argon\NewsBundle\Entity\NewsPost;

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

        $form = $this->createForm('news_post', $post, array(
            'action' => $this->generateUrl('admin_news_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit');

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

    protected function getRepository()
    {
        return $this->getDoctrine()->getRepository('ArgonNewsBundle:NewsPost');
    }
}