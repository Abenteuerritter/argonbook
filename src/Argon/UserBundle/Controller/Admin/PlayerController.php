<?php

namespace Argon\UserBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PlayerController extends Controller
{
    public function indexAction(Request $request)
    {
        $query = $this->getDoctrine()
                      ->getRepository('ArgonUserBundle:Player')
                      ->createQuery();

        $pagination = $this->get('knp_paginator')->paginate($query,
            $request->query->getInt('page', 1)
        );

        return $this->render('ArgonUserBundle:Admin\Player:index.html.twig', array(
            'entities' => $pagination,
        ));
    }
}