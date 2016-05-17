<?php

namespace Argon\GameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlockController extends Controller
{
    public function charactersAction()
    {
        $this->denyAccessUnlessGranted('ROLE_PLAYER');

        $player   = $this->getUser();
        $entities = $this->getRepository()
                         ->findByPlayer($player);

        return $this->render('ArgonGameBundle:Block:characters.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * @return \Argon\GameBundle\Repository\CharacterRepository
     */
    protected function getRepository()
    {
        return $this->getDoctrine()->getRepository('ArgonGameBundle:Character');
    }
}