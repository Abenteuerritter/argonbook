<?php

namespace Argon\GameBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Argon\GameBundle\Entity\Friend;
use Argon\GameBundle\Entity\Character;
use Argon\GameBundle\Form\Friend\FriendRelationType;
use Argon\GameBundle\Form\Friend\FriendRelationAcceptType;

class FriendlistController extends Controller
{
    public function indexAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_PJ', null,
            'You must be logged as a character.');

        /** @var Character $character */
        $character = $this->getUser();

        /** @var \Argon\GameBundle\Repository\FriendRepository $repository */
        $repository = $this->getDoctrine()->getRepository(Friend::class);

        $friends = $repository->findAcceptedByCharacter($character);
        $pending = $repository->findPendingByCharacter($character);

        $pagination = $this->get('knp_paginator')->paginate($friends,
            $request->query->getInt('page', 1)
        );

        return $this->render('ArgonGameBundle:Friendlist:index.html.twig', array(
            'friends' => $pagination,
            'pending' => (new ArrayCollection($pending))->map(function(Friend $r) use($character) {
                return $r->getFriendOf($character);
            }),
        ));
    }

    public function relationAction(Request $request, $slug)
    {
        $this->denyAccessUnlessGranted('ROLE_PJ', null,
            'You must be logged as a character.');

        /** @var Character $leftCharacter */
        $leftCharacter = $this->getUser();

        /** @var Character $rightCharacter */
        $rightCharacter = $this->getDoctrine()->getRepository(Character::class)->findOneBySlug($slug);

        if ($rightCharacter === null) {
            throw $this->createNotFoundException('Character not found.');
        }

        $relation = $this->getDoctrine()->getRepository(Friend::class)->findRelationBetween(
            $leftCharacter,
            $rightCharacter
        );

        $info = null;
        $createForm = null;
        $acceptForm = null;

        if ($relation) {
            $info = array(
                'sameGame' => $leftCharacter->getGameName() === $rightCharacter->getGameName(),
            );

            if (!$relation->isAccepted() && $relation->getRightCharacter()->isEqualTo($leftCharacter)) {
                $acceptForm = $this->createForm(FriendRelationAcceptType::class, null, array(
                    'action' => $this->generateUrl('friendlist_relation_accept', array('slug' => $slug)),
                    'method' => 'POST',
                ));

                $acceptForm->add('submit', SubmitType::class, array(
                    'label' => 'friendlist.relation_accept',
                    'attr'  => array('class' => 'button'),
                ));
            }
        } else {
            $createForm = $this->createForm(FriendRelationType::class, null, array(
                'action' => $this->generateUrl('friendlist_relation_create', array('slug' => $slug)),
                'method' => 'POST',
            ));

            $createForm->add('submit', SubmitType::class, array(
                'label' => 'friendlist.relation_submit',
                'attr'  => array('class' => 'button'),
            ));
        }

        return $this->render('ArgonGameBundle:Friendlist:view.html.twig', array(
            'leftCharacter'  => $leftCharacter,
            'rightCharacter' => $rightCharacter,
            'relation'       => $relation,
            'info'           => $info,
            'createForm'     => $createForm ? $createForm->createView() : null,
            'acceptForm'     => $acceptForm ? $acceptForm->createView() : null,
        ));
    }

    public function relationCreateAction(Request $request, $slug)
    {
        $this->denyAccessUnlessGranted('ROLE_PJ', null,
            'You must be logged as a character.');

        /** @var Character $leftCharacter */
        $leftCharacter = $this->getUser();

        /** @var Character $rightCharacter */
        $rightCharacter = $this->getDoctrine()->getRepository(Character::class)->findOneBySlug($slug);

        if ($rightCharacter === null) {
            throw $this->createNotFoundException('Character not found.');
        }

        $createForm = $this->createForm(FriendRelationType::class);
        $createForm->add('submit');
        $createForm->handleRequest($request);

        if ($createForm->isSubmitted() && $createForm->isValid()) {
            $em = $this->getDoctrine()->getManagerForClass(Friend::class);
            $em->merge(new Friend($leftCharacter, $rightCharacter));
            $em->flush();
        }

        return $this->redirect($this->generateUrl('friendlist_relation', array('slug' => $slug)));
    }

    public function relationAcceptAction(Request $request, $slug)
    {
        $this->denyAccessUnlessGranted('ROLE_PJ', null,
            'You must be logged as a character.');

        /** @var Character $leftCharacter */
        $leftCharacter = $this->getUser();

        /** @var Character $rightCharacter */
        $rightCharacter = $this->getDoctrine()->getRepository(Character::class)->findOneBySlug($slug);

        if ($rightCharacter === null) {
            throw $this->createNotFoundException('Character not found.');
        }

        /** @var Friend $relation */
        $relation = $this->getDoctrine()->getRepository(Friend::class)->findRelationBetween(
            $leftCharacter,
            $rightCharacter
        );

        if ($relation === null) {
            throw $this->createNotFoundException('Friendship not found.');
        }

        if (!$relation->getRightCharacter()->isEqualTo($leftCharacter)) {
            throw $this->createAccessDeniedException('Cannot accept a friendship that is not requested to you.');
        }

        $acceptForm = $this->createForm(FriendRelationAcceptType::class);
        $acceptForm->add('submit');
        $acceptForm->handleRequest($request);

        if ($acceptForm->isSubmitted() && $acceptForm->isValid()) {
            $relation->setRightAcceptedAt(new \DateTime);

            $em = $this->getDoctrine()->getManagerForClass(Friend::class);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('friendlist_relation', array('slug' => $slug)));
    }
}