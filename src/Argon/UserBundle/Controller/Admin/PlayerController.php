<?php

namespace Argon\UserBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PlayerController extends Controller
{
    public function indexAction()
    {
        $query = $this->getDoctrine()
                      ->getRepository('ArgonUserBundle:Player')
                      ->createQuery();

        $pagination = $this->get('knp_paginator')->paginate($query,
            $this->get('request')->query->get('page', 1)
        );

        return $this->render('ArgonUserBundle:Admin\Player:index.html.twig', array(
            'entities' => $pagination,
        ));
    }
}