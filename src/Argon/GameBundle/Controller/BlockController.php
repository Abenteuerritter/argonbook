<?php

namespace Argon\GameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Argon\GameBundle\Entity\Character;

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

    /**
     * @return \Argon\GameBundle\Repository\CharacterRepository
     */
    protected function getRepository()
    {
        return $this->getDoctrine()->getRepository(Character::class);
    }
}