<?php

namespace Argon\GameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

use Argon\GameBundle\Entity\Character;
use Argon\GameBundle\Entity\CharacterAbility;
use Argon\GameBundle\Entity\CharacterSkill;

use Argon\GameBundle\Form\Character\CharacterEditType;
use Argon\GameBundle\Form\Character\CharacterGameType;
use Argon\GameBundle\Form\Character\CharacterSkillsType;
use Argon\GameBundle\Form\Type\CharacterType;

use Argon\GameBundle\Provider\GameInterface;

class CharacterController extends Controller
{
    public function indexAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_PLAYER', null,
            'You must be logged in to see your characters.');

        return $this->render('ArgonGameBundle:Character:index.html.twig');
    }

    public function gameAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_PLAYER', null,
            'You must be logged in to create a new character.');

        $form = $this->createForm(CharacterGameType::class, null, array(
            'action' => $this->generateUrl('character_game'),
            'method' => 'POST',
        ));

        $form->add('submit', SubmitType::class, array(
            'label' => 'character.game_submit',
            'attr'  => array('class' => 'button'),
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $game = $data['game'];

            return $this->redirect($this->generateUrl('character_new', array(
                'game' => $game->getName(),
            )));
        }

        return $this->render('ArgonGameBundle:Character:game.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function newAction(Request $request, GameInterface $game)
    {
        $this->denyAccessUnlessGranted('ROLE_PLAYER', null,
            'You must be logged in to create a new character.');

        $player = $this->getUser();

        $character = new Character();
        $character->setPlayer($player);
        $character->setGame($game);

        foreach ($game->getAbilities() as $characterAbilityCode) {
            $characterAbility = new CharacterAbility();
            $characterAbility->setCode($characterAbilityCode);
            $characterAbility->setCharacter($character);

            $character->addAbility($characterAbility);
        }

        $form = $this->createForm(CharacterType::class, $character, array(
            'game'   => $game,
            'action' => $this->generateUrl('character_create', array('game' => $game->getName())),
            'method' => 'POST',
        ));

        $form->add('submit', SubmitType::class, array(
            'label' => 'character.submit',
            'attr'  => array('class' => 'button'),
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($character);
            $em->flush();

            $request->getSession()->getFlashBag()
                    ->add('success', 'character.created');

            return $this->redirect($this->generateUrl('character'));
        }

        return $this->render('ArgonGameBundle:Character:new.html.twig', array(
            'game' => $game,
            'form' => $form->createView(),
        ));
    }

    public function viewAction(Character $character)
    {
        $storyNote   = null;
        $experiences = null;

        $own = ($this->isGranted('ROLE_PJ') && $character->isEqualTo($this->getUser())) ||
               ($this->isGranted('ROLE_PLAYER') && $character->getPlayer()->isEqualTo($this->getUser()));

        if ($own || $this->isGranted('ROLE_DIRECTOR')) {
            $storyNote   = $this->getMarkdownParser()->parse($character->getNote());
            $experiences = $this->getDoctrine()
                                ->getRepository('ArgonGameBundle:CharacterExperience')
                                ->findByCharacter($character);
        }

        return $this->render('ArgonGameBundle:Character:view.html.twig', array(
            'character'   => $character,
            'story_note'  => $storyNote,
            'experiences' => $experiences,
        ));
    }

    public function skillsAction(Character $character, Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_PLAYER', null,
            'You must be logged in to update this character.');

        $player = $this->getUser();

        if ($player !== $character->getPlayer()) {
            throw new AccessDeniedException();
        }

        $characterSkills = new ArrayCollection();
        $skills          = $this->getDoctrine()
                                ->getRepository('ArgonGameBundle:Skill')
                                ->findAllByGame($character->getGame());

        foreach ($skills as $skill) {
            $found = $character->getSkills()->filter(function ($characterSkill) use ($skill) {
                return $characterSkill->getSkill() === $skill;
            });

            if (count($found) > 0) {
                $characterSkill = $found->first();
            } else {
                $characterSkill = new CharacterSkill();
                $characterSkill->setCharacter($character);
                $characterSkill->setSkill($skill);
            }

            $characterSkills[] = $characterSkill;
        }

        // {{{ Order By Price
        $criteria = new Criteria();
        $criteria->orderBy(array('price' => Criteria::ASC));

        $characterSkills = $characterSkills->matching($criteria);
        // }}}

        $form = $this->createForm(CharacterSkillsType::class, array('characterSkills' => $characterSkills), array(
            'action' => $this->generateUrl('character_skills_update', array('slug' => $character->getSlug())),
            'method' => 'POST',
        ));

        $form->add('submit', SubmitType::class, array(
            'label' => 'character_skill.submit',
            'attr'  => array('class' => 'button'),
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $manager = $this->getDoctrine()->getManager();

            $characterSkills = $formData['characterSkills'];

            foreach ($characterSkills as $characterSkill) {
                if ($characterSkill->isNextRemoved()) {
                    if ($characterSkill->getId() !== null) {
                        $manager->remove($characterSkill);
                    }
                } else {
                    if ($characterSkill->getId() === null) {
                        $manager->persist($characterSkill);
                    } else {
                        // To be updated
                    }
                }
            }

            $manager->flush();

            $request->getSession()->getFlashBag()
                    ->add('success', 'character_skill.updated');

            return $this->redirect($this->generateUrl('character'));
        }

        return $this->render('ArgonGameBundle:Character:skills.html.twig', array(
            'character' => $character,
            'form'      => $form->createView(),
            'skills'    => $skills,
        ));
    }

    public function editAction(Character $character, Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_PLAYER', null,
            'You must be logged in to update this character.');

        $player = $this->getUser();

        if ($player !== $character->getPlayer()) {
            throw new AccessDeniedException();
        }

        $form = $this->createForm(CharacterEditType::class, $character, array(
            'action' => $this->generateUrl('character_edit_update', array('slug' => $character->getSlug())),
            'method' => 'POST',
        ));

        $form->add('submit', SubmitType::class, array(
            'label' => 'character.edit_submit',
            'attr'  => array('class' => 'button'),
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->flush();

            $request->getSession()->getFlashBag()
                    ->add('success', 'character.updated');

            return $this->redirect($this->generateUrl('character'));
        }

        return $this->render('ArgonGameBundle:Character:edit.html.twig', array(
            'character'  => $character,
            'story_note' => $this->getMarkdownParser()->parse($character->getNote()),
            'form'       => $form->createView(),
        ));
    }

    /**
     * @return \cebe\markdown\Markdown
     */
    protected function getMarkdownParser()
    {
        return $this->container->get('cebe.markdown');
    }
}