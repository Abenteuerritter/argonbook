<?php

namespace Argon\GameBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GameController extends Controller
{
    public function indexAction()
    {
        $games = $this->getDoctrine()
                      ->getRepository('ArgonGameBundle:Game')
                      ->findAll();

        return $this->render('ArgonGameBundle:Admin\Game:index.html.twig', array(
            'games' => $games,
        ));
    }
}