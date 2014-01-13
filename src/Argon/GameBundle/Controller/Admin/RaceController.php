<?php

namespace Argon\GameBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RaceController extends Controller
{
    public function indexAction()
    {
        $entities = $this->getDoctrine()
                         ->getRepository('ArgonGameBundle:Race')
                         ->findAll();

        return $this->render('ArgonGameBundle:Admin\Race:index.html.twig', array(
            'entities' => $entities,
        ));
    }
}