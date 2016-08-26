<?php

namespace Argon\GameBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Argon\GameBundle\Entity\Character;
use Argon\GameBundle\Entity\CharacterExperience;
use Argon\GameBundle\Entity\CharacterFilter;

use Argon\GameBundle\Form\Type\CharacterFilterType;
use Argon\GameBundle\Form\Type\CharacterExperienceType;
use Argon\GameBundle\Form\Character\CharacterStoryConfirmType;

class CharacterController extends Controller
{
    public function indexAction(Request $request)
    {
        /** @var \Argon\GameBundle\Repository\CharacterRepository $repository */
        $repository = $this->getDoctrine()
                           ->getRepository('ArgonGameBundle:Character');

        $filter     = new CharacterFilter();
        $filterForm = $this->createForm(CharacterFilterType::class, $filter);

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
            $request->query->getInt('page', 1)
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

        $form = $this->createForm(CharacterExperienceType::class, $characterExperience, array(
            'action' => $this->generateUrl('admin_character_experience_create', array('id' => $character->getId())),
            'method' => 'POST',
        ));

        $form->add('submit', SubmitType::class, array(
            'label' => 'admin.character_experience.create',
            'attr'  => array('class' => 'button'),
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $character->addExperience(
                $characterExperience->getValue()
            );

            $em = $this->getDoctrine()->getManager();
            $em->persist($characterExperience);
            $em->flush();

            $request->getSession()->getFlashBag()
                    ->add('success', 'admin.character_experience.created');

            return $this->redirect($this->generateUrl('admin_character_experience', array(
                'id' => $character->getId(),
            )));
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

        $form = $this->createForm(CharacterStoryConfirmType::class, null, array(
            'action' => $this->generateUrl('admin_character_confirm_story_update', array('id' => $character->getId())),
            'method' => 'POST',
        ));

        $form->add('submit', SubmitType::class, array(
            'label' => 'admin.character.confirm_story_submit',
            'attr'  => array('class' => 'button'),
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            if (empty($data['reason'])) {
                $data['reason'] = $this->get('translator')->trans('character.story_confirm_reason');
            }

            $characterExperience = new CharacterExperience();
            $characterExperience->setCharacter($character);
            $characterExperience->setValue($data['experience']);
            $characterExperience->setReason($data['reason']);

            $character->setNote($data['note']);
            $character->setStoryConfirmedAt(new \DateTime());
            $character->addExperience(
                $characterExperience->getValue()
            );

            $em = $this->getDoctrine()->getManager();
            $em->persist($characterExperience);
            $em->flush();

            $request->getSession()->getFlashBag()
                    ->add('success', 'admin.character.story_confirmed');

            return $this->redirect($this->generateUrl('admin_character'));
        }

        return $this->render('ArgonGameBundle:Admin\Character:confirmStory.html.twig', array(
            'character' => $character,
            'form'      => $form->createView(),
        ));
    }
}