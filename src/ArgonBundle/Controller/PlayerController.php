<?php

namespace ArgonBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PlayerController extends Controller
{
    /**
     * @Route("/playerlist", name="playerlist")
     */
    public function playerlistAction(Request $request)
    {
        $page    = $request->query->getInt('p', 1);
        $players = $this->getDoctrine()->getRepository('ArgonBundle\Entity\Player')->findByPage($page);

        return $this->render('playerlist.html.twig', array(
            'page'    => $page,
            'players' => $players,
        ));
    }
}
