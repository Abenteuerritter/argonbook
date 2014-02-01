<?php

namespace Argon\GameBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Argon\GameBundle\Entity\Character;

class CharacterController extends Controller
{
    public function indexAction(Request $request)
    {
        $game = $request->query->get('game');

        $repository = $this->getDoctrine()
                           ->getRepository('ArgonGameBundle:Character');

        if (null === $game) {
            $entities = $repository->findAll();
        } else {
            $entities = $repository->findByGameName($game);
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