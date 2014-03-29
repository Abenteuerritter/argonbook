<?php

namespace Argon\GameBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Argon\GameBundle\Entity\Character;
use Argon\GameBundle\Entity\CharacterExperience;
use Argon\GameBundle\Entity\CharacterFilter;

class CharacterController extends Controller
{
    public function indexAction(Request $request)
    {
        $repository = $this->getDoctrine()
                           ->getRepository('ArgonGameBundle:Character');

        $filter     = new CharacterFilter();
        $filterForm = $this->createForm('character_filter', $filter);

        $game = null;

        if ($request->query->has('game')) {
            $gameName    = $request->query->get('game');
            $gameFactory = $this->container->get('argon_game.provider.game_factory');
            $game        = $gameFactory->create($gameName);

            $query = $repository->createQueryByGameName($gameName);
        } else {
            $query = $repository->createQuery();
        }

        $pagination = $this->get('knp_paginator')->paginate($query,
            $this->get('request')->query->get('page', 1)
        );

        return $this->render('ArgonGameBundle:Admin\Character:index.html.twig', array(
            'game'        => $game,
            'entities'    => $pagination,
            'filter_form' => $filterForm->createView(),
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

    public function newExperienceAction(Character $character, Request $request)
    {
        $characterExperience = new CharacterExperience();
        $characterExperience->setCharacter($character);

        $form = $this->createForm('character_experience', $characterExperience, array(
            'action' => $this->generateUrl('admin_character_experience_create', array('id' => $character->getId())),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit');

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $character->addExperience(
                    $characterExperience->getValue()
                );

                $em = $this->getDoctrine()->getManager();
                $em->persist($characterExperience);
                $em->flush();

                $request->getSession()->getFlashBag()
                        ->add('success', 'character_experience.created');

                return $this->redirect($this->generateUrl('admin_character_experience', array(
                    'id' => $character->getId(),
                )));
            }
        }

        return $this->render('ArgonGameBundle:Admin\Character:newExperience.html.twig', array(
            'character' => $character,
            'form'      => $form->createView(),
        ));
    }

    public function skillAction(Character $character)
    {
        $entities = $this->getDoctrine()
                         ->getRepository('ArgonGameBundle:CharacterSkill')
                         ->findByCharacter($character);

        return $this->render('ArgonGameBundle:Admin\Character:skill.html.twig', array(
            'character' => $character,
            'entities'  => $entities,
        ));
    }

    public function confirmStoryAction(Character $character, Request $request)
    {
        if (!$character->isStoryNotConfirmed()) {
            return $this->createNotFoundException(
                sprintf('Story for %s not available to confirm.', (string) $character)
            );
        }

        $form = $this->createForm('character_story_confirm', null, array(
            'action' => $this->generateUrl('admin_character_confirm_story_update', array('id' => $character->getId())),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit');

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $data = $form->getData();

                $characterExperience = new CharacterExperience();
                $characterExperience->setCharacter($character);
                $characterExperience->setValue($data['experience']);
                $characterExperience->setReason(
                    $this->get('translator')->trans('character.story_confirm_reason', array(), 'admin')
                );

                $character->setStoryConfirmedAt(new \DateTime());
                $character->addExperience(
                    $characterExperience->getValue()
                );

                $em = $this->getDoctrine()->getManager();
                $em->persist($characterExperience);
                $em->flush();

                $request->getSession()->getFlashBag()
                        ->add('success', 'character.story_confirmed');

                return $this->redirect($this->generateUrl('admin_character'));
            }
        }

        return $this->render('ArgonGameBundle:Admin\Character:confirmStory.html.twig', array(
            'character' => $character,
            'form'      => $form->createView(),
        ));
    }
}