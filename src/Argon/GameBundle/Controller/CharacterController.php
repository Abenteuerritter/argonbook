<?php

namespace Argon\GameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use Argon\GameBundle\Entity\Character;

class CharacterController extends Controller
{
    public function gameAction(Request $request)
    {
        if (false === $this->get('security.context')->isGranted('ROLE_USER')) {
            throw new AccessDeniedException();
        }

        $form = $this->createForm('character_game', null, array(
            'action' => $this->generateUrl('character_game'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit');

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $data = $form->getData();
                $game = $data['game'];

                return $this->redirect($this->generateUrl('character_new', array(
                    'game' => $game,
                )));
            }
        }

        return $this->render('ArgonGameBundle:Character:game.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function newAction(Request $request, $game)
    {
        if (false === $this->get('security.context')->isGranted('ROLE_USER')) {
            throw new AccessDeniedException();
        }

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
            'action' => $this->generateUrl('character_create', array('game' => $gameName)),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit');

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($character);
                $em->flush();

                $request->getSession()->getFlashBag()
                        ->add('notice', 'character.created');

                return $this->redirect($this->generateUrl('homepage'));
            }
        }

        return $this->render('ArgonGameBundle:Character:new.html.twig', array(
            'game' => $game,
            'form' => $form->createView(),
        ));
    }
}