<?php

namespace Argon\GameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FOS\Message\Repository;
use FOS\Message\Model\Conversation;

use Argon\GameBundle\Entity\Character;
use Argon\GameBundle\Entity\Friend;

class MessengerController extends Controller
{
    public function indexAction()
    {
        $this->denyAccessUnlessGranted('ROLE_PJ', null,
            'You must be logged as a character.');

        /** @var Character $character */
        $character = $this->getUser();

        /** @var Repository $repository */
        $repository = $this->get('fos_message.repository');

        return $this->render('ArgonGameBundle:Messenger:index.html.twig', array(
            'conversations' => $repository->getPersonConversations($character),
        ));
    }

    public function viewAction($slug, $id = null)
    {
        $this->denyAccessUnlessGranted('ROLE_PJ', null,
            'You must be logged as a character.');

        /** @var Character $sender */
        $sender = $this->getUser();

        /** @var Character $recipient */
        $recipient = $this->getDoctrine()->getRepository(Character::class)->findOneBySlug($slug);

        if ($recipient === null) {
            throw $this->createNotFoundException('Recipient not found.');
        }

        /** @var Friend $friendship */
        $friendship = $this->getDoctrine()->getRepository(Friend::class)->findRelationBetween($sender, $recipient);

        if ($friendship === null || !$friendship->isAccepted()) {
            throw $this->createAccessDeniedException('Can only communicate with friends.');
        }

        /** @var Repository $repository */
        $repository = $this->get('fos_message.repository');

        return $this->render('ArgonGameBundle:Messenger:conversation.html.twig', array(
            'sender'        => $sender,
            'recipient'     => $recipient,
            'conversations' => $this->getConversationsBetween($repository, $sender, $recipient),
        ));
    }

    public function replyAction($slug, $id = null)
    {

    }

    /**
     * Retrieve all conversations between two characters. Null otherwise.
     *
     * @param Repository $repository
     * @param Character  $left
     * @param Character  $right
     *
     * @return Conversation[]
     */
    private function getConversationsBetween(Repository $repository, Character $left, Character $right)
    {
        $all = $repository->getPersonConversations($left);
        $ret = [];

        foreach ($all as $conversation) {
            if (count($conversation->getConversationPersons()) === 1 && $conversation->isPersonInConversation($right)) {
                $ret[] = $conversation;
            }
        }

        return $ret;
    }
}