<?php

namespace Argon\GameBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Argon\GameBundle\Entity\Character;

class CharacterController extends Controller
{
    public function indexAction(Request $request)
    {
        $repository = $this->getDoctrine()
                           ->getRepository('ArgonGameBundle:Character');

        $game = null;

        if ($request->query->has('game')) {
            $gameName    = $request->query->get('game');
            $gameFactory = $this->container->get('argon_game.provider.game_factory');
            $game        = $gameFactory->create($gameName);

            $entities = $repository->findByGameName($gameName);
        } else {
            $entities = $repository->findAll();
        }

        return $this->render('ArgonGameBundle:Admin\Character:index.html.twig', array(
            'game'     => $game,
            'entities' => $entities,
        ));
    }

    public function experienceAction(Character $character)
    {
        $entities = $this->getDoctrine()
                         ->getRepository('ArgonGameBundle:CharacterExperience')
                         ->findByCharacter($character);

        return $this->render('ArgonGameBundle:Admin\Character:experience.html.twig', array(
            'character' => $character,
            'entities'  => $entities,
        ));
    }
}