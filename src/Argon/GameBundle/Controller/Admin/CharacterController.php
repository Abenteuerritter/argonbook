<?php

namespace Argon\GameBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CharacterController extends Controller
{
    public function indexAction()
    {
        $characters = $this->getDoctrine()
                           ->getRepository('ArgonGameBundle:Character')
                           ->findAll();

        return $this->render('ArgonGameBundle:Admin\Character:index.html.twig', array(
            'entities' => $characters,
        ));
    }
}