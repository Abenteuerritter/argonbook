<?php

namespace Argon\CommonBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PlayerController extends Controller
{
    public function indexAction()
    {
        $query = $this->getDoctrine()
                      ->getRepository('ArgonCommonBundle:Player')
                      ->createQuery();

        $pagination = $this->get('knp_paginator')->paginate($query,
            $this->get('request')->query->get('page', 1)
        );

        return $this->render('ArgonCommonBundle:Admin\Player:index.html.twig', array(
            'entities' => $pagination,
        ));
    }
}