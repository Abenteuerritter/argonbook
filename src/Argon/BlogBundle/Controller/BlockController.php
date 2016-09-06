<?php

namespace Argon\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Argon\BlogBundle\Entity\Post;
use Argon\BlogBundle\Entity\Comment;

class BlockController extends Controller
{
    public function latestAction()
    {
        $entities = $this->getRepository()->findLatest();

        return $this->render('ArgonBlogBundle:Block:latest.html.twig', array(
            'entities' => $entities,
        ));
    }

    public function postAction(Post $post, $position = null)
    {
        return $this->render('ArgonBlogBundle:Block:post.html.twig', array(
            'post_rendered' => $this->getMarkdownParser()->parse($post->getBody()),
            'post'          => $post,
            'position'      => $position,
        ));
    }

    public function commentAction(Comment $comment)
    {
        return $this->render('ArgonBlogBundle:Block:comment.html.twig', array(
            'comment' => $comment,
        ));
    }

    /**
     * @return \Argon\BlogBundle\Repository\PostRepository
     */
    protected function getRepository()
    {
        return $this->getDoctrine()->getRepository('ArgonBlogBundle:Post');
    }

    /**
     * @return \cebe\markdown\Markdown
     */
    protected function getMarkdownParser()
    {
        return $this->container->get('cebe.markdown');
    }
}