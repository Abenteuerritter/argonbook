<?php

namespace Argon\GameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use FOS\Message\Model\Conversation;

use Argon\GameBundle\Entity\Character;
use Argon\GameBundle\Form\Messenger\MessageReplyType;

class BlockController extends Controller
{
    public function charactersAction(
        $characters = null,
        $linkSwitch = null,
        $showEdit   = null,
        $showAccept = null
    ) {
        if ($characters === null) {
            $this->denyAccessUnlessGranted('ROLE_PLAYER');

            $player     = $this->getUser();
            $characters = $this->getRepository()->findByPlayer($player);
        }

        return $this->render('ArgonGameBundle:Block:characters.html.twig', array(
            'characters' => $characters,
            'linkSwitch' => !is_string($linkSwitch) ? null : $linkSwitch,
            'showSwitch' => !is_null($linkSwitch) && $this->isGranted('ROLE_PLAYER'),
            'showEdit'   => !is_null($showEdit) && $showEdit && $this->isGranted('ROLE_PLAYER'),
            'showAccept' => !is_null($showAccept) && $showAccept && $this->isGranted('ROLE_PJ'),
        ));
    }

    public function characterNickAction(
        Character $character,
        $showPlayer     = null,
        $showStats      = null,
        $linkExperience = null,
        $linkSkills     = null
    ) {
        $own = ($this->isGranted('ROLE_PJ') && $character->isEqualTo($this->getUser())) ||
               ($this->isGranted('ROLE_PLAYER') && $character->getPlayer()->isEqualTo($this->getUser()));

        return $this->render('ArgonGameBundle:Block:character_nick.html.twig', array(
            'showPlayer'     => (!is_null($showPlayer) && $showPlayer) || !$own || $this->isGranted('ROLE_SUPER_ADMIN'),
            'showStats'      => (!is_null($showStats) && $showStats) || $linkExperience || $linkSkills,
            'linkExperience' => $linkExperience,
            'linkSkills'     => $linkSkills,
            'character'      => $character,
        ));
    }

    public function messageAction() {}

    public function messageReplyAction(Character $recipient, Conversation $conversation = null)
    {
        $data = null;

        if ($conversation) {
            $action = $this->generateUrl('messenger_reply', array(
                'slug' => $recipient->getSlug(),
                'id'   => $conversation->getId(),
            ));

            $data = array(
                'subject' => $conversation->getSubject(),
            );
        } else {
            $action = $this->generateUrl('messenger_reply', array('slug' => $recipient->getSlug()));
        }

        $form = $this->createForm(MessageReplyType::class, $data, array(
            'action' => $action,
            'method' => 'POST',
        ));

        $form->add('submit', SubmitType::class, array(
            'label' => 'messenger.send',
            'attr'  => array('class' => 'button'),
        ));

        return $this->render('ArgonGameBundle:Block:message_reply.html.twig', array(
            'form'         => $form->createView(),
            'recipient'    => $recipient,
            'conversation' => $conversation,
        ));
    }

    /**
     * @return \Argon\GameBundle\Repository\CharacterRepository
     */
    protected function getRepository()
    {
        return $this->getDoctrine()->getRepository(Character::class);
    }
}