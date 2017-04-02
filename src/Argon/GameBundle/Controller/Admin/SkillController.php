<?php

namespace Argon\GameBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Argon\GameBundle\Entity\Skill;
use Argon\GameBundle\Form\Skill\SkillEditType;

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

    public function viewAction($slug)
    {
        /** @var Skill $skill */
        $skill = $this->getRepository()->findOneBySlug($slug);

        return $this->render('ArgonGameBundle:Admin/Skill:view.html.twig', array(
            'entity' => $skill,
        ));
    }

    public function editAction(Request $request, $slug)
    {
        /** @var Skill $skill */
        $skill = $this->getRepository()->findOneBySlug($slug);

        $form = $this->createForm(SkillEditType::class, $skill, array(
            'action' => $this->generateUrl('admin_skill_edit_update', array('slug' => $skill->getSlug())),
            'method' => 'POST',
        ));

        $form->add('submit', SubmitType::class, array(
            'label' => 'admin.skill.edit_submit',
            'attr'  => array('class' => 'button'),
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->flush();

            $request->getSession()->getFlashBag()
                    ->add('success', 'admin.skill.updated');

            return $this->redirect($this->generateUrl('admin_skill_view', array('slug' => $skill->getSlug())));
        }

        return $this->render('ArgonGameBundle:Admin/Skill:edit.html.twig', array(
            'skill' => $skill,
            'form'  => $form->createView(),
        ));
    }

    /**
     * @return \Argon\GameBundle\Repository\SkillRepository
     */
    protected function getRepository()
    {
        return $this->getDoctrine()->getRepository(Skill::class);
    }
}