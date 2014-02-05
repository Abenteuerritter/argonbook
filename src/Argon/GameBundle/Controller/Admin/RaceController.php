<?php

namespace Argon\GameBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Argon\GameBundle\Entity\Race;

class RaceController extends Controller
{
    public function indexAction()
    {
        $entities = $this->getRepository()->findAll();

        return $this->render('ArgonGameBundle:Admin/Race:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    public function viewAction(Race $race)
    {
        return $this->render('ArgonGameBundle:Admin/Race:view.html.twig', array(
            'entity' => $race,
        ));
    }

    protected function getRepository()
    {
        return $this->getDoctrine()->getRepository('ArgonGameBundle:Race');
    }
}