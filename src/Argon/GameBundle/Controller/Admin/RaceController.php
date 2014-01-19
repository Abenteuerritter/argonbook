<?php

namespace Argon\GameBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RaceController extends Controller
{
    public function indexAction(Request $request)
    {
        $repository = $this->getDoctrine()
                           ->getRepository('ArgonGameBundle:Race');

        $parentCode = $request->query->get('parent', null);
        $parent     = $repository->findOneByCode($parentCode);
        $entities   = $repository->findByParent($parent);

        return $this->render('ArgonGameBundle:Admin\Race:index.html.twig', array(
            'entities' => $entities,
        ));
    }
}