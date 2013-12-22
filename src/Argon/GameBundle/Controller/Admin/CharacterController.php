<?php

namespace Argon\GameBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Argon\CommonBundle\Entity\Player;
use Argon\GameBundle\Entity\Character;

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