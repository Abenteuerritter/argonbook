<?php

namespace Argon\GameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Argon\GameBundle\Provider\GameInterface;

class GameController extends Controller
{
    public function indexAction()
    {
        $gameFactory = $this->get('argon_game.provider.game_factory');
        $games       = $gameFactory->getGames();

        return $this->render('ArgonGameBundle:Game:index.html.twig', array(
            'games' => $games,
        ));
    }

    public function viewAction(GameInterface $game)
    {
        return $this->render('ArgonGameBundle:Game:view.html.twig', array(
            'game' => $game,
        ));
    }
}