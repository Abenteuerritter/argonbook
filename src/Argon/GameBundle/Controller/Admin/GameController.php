<?php

namespace Argon\GameBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Argon\GameBundle\Entity\Game;

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

    public function newAction()
    {
        $game = new Game();
        $form = $this->createCreateForm($game);

        return $this->render('ArgonGameBundle:Admin\Game:new.html.twig', array(
            'game' => $game,
            'form' => $form->createView(),
        ));
    }

    public function createAction(Request $request)
    {
        $game = new Game();
        $form = $this->createCreateForm($game);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($game);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_game'));
        }

        return $this->render('ArgonGameBundle:Admin\Game:new.html.twig', array(
            'game' => $game,
            'form' => $form->createView(),
        ));
    }

    private function createCreateForm(Game $game)
    {
        $form = $this->createForm('game', $game, array(
            'action' => $this->generateUrl('admin_game_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit');

        return $form;
    }
}