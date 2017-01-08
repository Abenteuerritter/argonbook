<?php

namespace Argon\GameBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Argon\GameBundle\Entity\Race;
use Argon\GameBundle\Form\Race\RaceEditType;

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

    public function editAction(Race $race, Request $request)
    {
        $form = $this->createForm(RaceEditType::class, $race, array(
            'action' => $this->generateUrl('admin_race_edit_update', array('slug' => $race->getSlug())),
            'method' => 'POST',
        ));

        $form->add('submit', SubmitType::class, array(
            'label' => 'admin.race.edit_submit',
            'attr'  => array('class' => 'button'),
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->flush();

            $request->getSession()->getFlashBag()
                    ->add('success', 'admin.race.updated');

            return $this->redirect($this->generateUrl('admin_race_view', array('slug' => $race->getSlug())));
        }

        return $this->render('ArgonGameBundle:Admin/Race:edit.html.twig', array(
            'race' => $race,
            'form' => $form->createView(),
        ));
    }

    protected function getRepository()
    {
        return $this->getDoctrine()->getRepository('ArgonGameBundle:Race');
    }
}