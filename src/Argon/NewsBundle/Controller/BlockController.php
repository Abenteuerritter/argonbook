<?php

namespace Argon\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Argon\NewsBundle\Entity\NewsPost;

class BlockController extends Controller
{
    public function latestAction()
    {
        $entities = $this->getRepository()->findLatest();

        return $this->render('ArgonNewsBundle:Block:latest.html.twig', array(
            'entities' => $entities,
        ));
    }

    public function postAction(NewsPost $post, $position = null)
    {
        return $this->render('ArgonNewsBundle:Block:post.html.twig', array(
            'post'     => $post,
            'position' => $position,
        ));
    }

    /**
     * @return \Argon\NewsBundle\Repository\NewsPostRepository
     */
    protected function getRepository()
    {
        return $this->getDoctrine()->getRepository('ArgonNewsBundle:NewsPost');
    }
}