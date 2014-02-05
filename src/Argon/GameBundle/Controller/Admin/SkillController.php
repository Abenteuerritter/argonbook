<?php

namespace Argon\GameBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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

    public function viewAction($code)
    {
        $repository = $this->getRepository();
        $entity     = $repository->findOneByCode($code);
        $entities   = $repository->findByParent($entity);

        return $this->render('ArgonGameBundle:Admin/Skill:view.html.twig', array(
            'entity'   => $entity,
            'entities' => $entities,
        ));
    }

    protected function getRepository()
    {
        return $this->getDoctrine()->getRepository('ArgonGameBundle:Skill');
    }
}