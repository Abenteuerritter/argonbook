<?php

namespace Argon\GameBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Argon\GameBundle\Entity\Skill;

class SkillController extends Controller
{
    public function indexAction(Request $request)
    {
        if ($request->query->has('ability')) {
            $ability  = $request->query->get('ability');
            $entities = $this->getRepository()->findByAbilityCode($ability);
        } else {
            $ability  = null;
            $entities = $this->getRepository()->findAll();
        }

        return $this->render('ArgonGameBundle:Admin/Skill:index.html.twig', array(
            'ability'  => $ability,
            'entities' => $entities,
        ));
    }

    public function viewAction(Skill $skill)
    {
        return $this->render('ArgonGameBundle:Admin/Skill:view.html.twig', array(
            'entity' => $skill,
        ));
    }

    protected function getRepository()
    {
        return $this->getDoctrine()->getRepository('ArgonGameBundle:Skill');
    }
}