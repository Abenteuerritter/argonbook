<?php

namespace Argon\NewsBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PostController extends Controller
{
    public function indexAction()
    {
        $entities = $this->getRepository()->findAll();

        return $this->render('ArgonNewsBundle:Admin\Post:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    protected function getRepository()
    {
        return $this->getDoctrine()->getRepository('ArgonNewsBundle:NewsPost');
    }
}