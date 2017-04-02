<?php

namespace Argon\GameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Argon\GameBundle\Entity\Character;
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

    public function viewAction(Request $request, $gameName)
    {
        /** @var GameInterface $game */
        $game = $this->getGameFactory()->create($gameName);

        $query = $this->getDoctrine()->getRepository(Character::class)->createQueryByGameName($gameName);

        $pagination = $this->get('knp_paginator')->paginate($query,
            $request->query->getInt('page', 1)
        );

        return $this->render('ArgonGameBundle:Game:view.html.twig', array(
            'game'       => $game,
            'characters' => $pagination,
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