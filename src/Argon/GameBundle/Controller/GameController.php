<?php

namespace Argon\GameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Argon\GameBundle\Provider\GameInterface;

class GameController extends Controller
{
    public function indexAction()
    {
        /** @var \Argon\GameBundle\Provider\GameInterface[]|array $games */
        $games = $this->getGameFactory()->getGames();

        return $this->render('ArgonGameBundle:Game:index.html.twig', array(
            'games' => $games,
        ));
    }

    public function viewAction($gameName)
    {
        /** @var GameInterface $game */
        $game = $this->getGameFactory()->create($gameName);

        return $this->render('ArgonGameBundle:Game:view.html.twig', array(
            'game' => $game,
        ));
    }

    /**
     * @return \Argon\GameBundle\Provider\GameFactory
     */
    protected function getGameFactory()
    {
        return $this->get('argon_game.provider.game_factory');
    }
}