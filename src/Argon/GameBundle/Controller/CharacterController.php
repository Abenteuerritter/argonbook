<?php

namespace Argon\GameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Argon\GameBundle\Entity\Character;

class CharacterController extends Controller
{
    public function gameAction(Request $request)
    {
        $form = $this->createForm('character_game', null, array(
            'action' => $this->generateUrl('character_game'),
            'method' => 'POST',
        ));

        if ($request->isMethod('POST')) {
            $data = $form->getData();
            $game = $data['game'];

            return $this->redirect($this->generateUrl('character_new', array(
                'game' => $game,
            )));
        }

        $form->add('submit', 'submit');

        return $this->render('ArgonGameBundle:Character:game.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function newAction(Request $request, $game)
    {
        $player = $this->getUser();

        // {{{ TODO: Rewrite me with Parameter Converter
        $gameName    = $game;
        $gameFactory = $this->container->get('argon_game.provider.game_factory');
        $game        = $gameFactory->create($gameName);
        // }}}

        if (null === $game) {
            throw $this->createNotFoundException(sprintf('Game %s not found.', $gameName));
        }

        $character = new Character();
        $character->setPlayer($player);
        $character->setGame($game);

        $form = $this->createForm('character', $character, array(
            'action' => $this->generateUrl('character_create'),
            'method' => 'POST',
        ));

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($character);
                $em->flush();

                // TODO Add flash message

                return $this->redirect($this->generateUrl('homepage'));
            }
        }

        $form->add('submit', 'submit');

        return $this->render('ArgonGameBundle:Character:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}