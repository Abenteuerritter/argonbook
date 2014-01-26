<?php

namespace Argon\CommonBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PlayerController extends Controller
{
    public function indexAction()
    {
        $entities = $this->getDoctrine()
                         ->getRepository('ArgonCommonBundle:Player')
                         ->findAll();

        return $this->render('ArgonCommonBundle:Admin\Player:index.html.twig', array(
            'entities' => $entities,
        ));
    }
}