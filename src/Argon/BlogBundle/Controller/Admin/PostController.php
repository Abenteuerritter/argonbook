<?php

namespace Argon\BlogBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Argon\BlogBundle\Entity\Post;

use Argon\BlogBundle\Form\Type\PostType;
use Argon\BlogBundle\Form\Type\PostPublishType;

class PostController extends Controller
{
    public function indexAction()
    {
        $entities = $this->getRepository()->findAll();

        return $this->render('ArgonBlogBundle:Admin\Post:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    public function newAction(Request $request)
    {
        $post = new Post();
        $post->setCreator($this->getUser());

        $form = $this->createForm(PostType::class, $post, array(
            'action' => $this->generateUrl('admin_blog_create'),
            'method' => 'POST',
        ));

        $form->add('submit', SubmitType::class, array(
            'label' => 'admin.blog.create',
            'attr'  => array('class' => 'button'),
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            $request->getSession()->getFlashBag()
                    ->add('success', 'admin.blog.created');

            return $this->redirect($this->generateUrl('admin_blog'));
        }

        return $this->render('ArgonBlogBundle:Admin\Post:new.html.twig', array(
            'post' => $post,
            'form' => $form->createView(),
        ));
    }

    public function viewAction($slug)
    {
        /** @var Post $post */
        $post = $this->getRepository()->findOneBySlug($slug);

        return $this->render('ArgonBlogBundle:Admin\Post:view.html.twig', array(
            'post'          => $post,
            'post_rendered' => $this->getMarkdownParser()->parse($post->getBody()),
        ));
    }

    public function publishAction(Request $request, $slug)
    {
        /** @var Post $post */
        $post = $this->getRepository()->findOneBySlug($slug);
        $post->setStatus(Post::STATUS_PUBLISHED);

        $form = $this->createForm(PostPublishType::class, $post, array(
            'action' => $this->generateUrl('admin_blog_publish', array('slug' => $post->getSlug())),
            'method' => 'POST',
        ));

        $form->add('submit', SubmitType::class, array(
            'label' => 'admin.blog.publish',
            'attr'  => array('class' => 'button'),
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $request->getSession()->getFlashBag()
                    ->add('success', 'admin.blog.published');

            return $this->redirect($this->generateUrl('admin_blog'));
        }

        return $this->render('ArgonBlogBundle:Admin\Post:publish.html.twig', array(
            'post' => $post,
            'form' => $form->createView(),
        ));
    }

    public function editAction(Request $request, $slug)
    {
        /** @var Post $post */
        $post = $this->getRepository()->findOneBySlug($slug);

        $preview = false;

        $form = $this->createForm(PostType::class, $post, array(
            'action' => $this->generateUrl('admin_blog_update', array('slug' => $post->getSlug())),
            'method' => 'POST',
        ));

        $form->add('preview', SubmitType::class, array(
            'label' => 'admin.blog.edit_preview',
            'attr'  => array('class' => 'secondary button'),
        ));

        $form->add('submit', SubmitType::class, array(
            'label' => 'admin.blog.edit_submit',
            'attr'  => array('class' => 'button'),
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rawData = $request->request->get($form->getName());

            if (isset($rawData['preview'])) {
                $preview = $this->getMarkdownParser()->parse($post->getBody());
            } else {
                $post->setModified();

                $em = $this->getDoctrine()->getManager();
                $em->flush();

                $request->getSession()->getFlashBag()
                        ->add('success', 'admin.blog.updated');

                return $this->redirect($this->generateUrl('admin_blog'));
            }
        }

        return $this->render('ArgonBlogBundle:Admin\Post:edit.html.twig', array(
            'post'    => $post,
            'preview' => $preview,
            'form'    => $form->createView(),
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