<?php

namespace Blogger\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Blogger\BlogBundle\Entity\Blog;
use Blogger\AdminBundle\Form\BlogType;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller
{
    public function newBlogAction() {
        return $this->render('BloggerAdminBundle:Blog:new.html.twig');
    }

    public function newAction()
    {
        $blog  = new Blog();
        $em = $this->
            getDoctrine();
        $blog->setCategory($em->getRepository('BloggerBlogBundle:Category')->getDefaultCategory()[0]);
        $form  = $this->createForm(new BlogType(), $blog);

        return $this->render('BloggerAdminBundle:Blog:form.html.twig', array(
            'blog' => $blog,
            'form' => $form->createView(),
            'create' => true
        ));
    }

    public function createAction(Request $request)
    {
        $blog  = new Blog();

        $form  = $this->createForm(new BlogType(), $blog);
        $form->submit($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()
                ->getManager();
            $em->persist($blog);
            $em->flush();

            return $this->redirect($this->generateUrl('BloggerAdminBundle_homepage'));
        }

        return $this->render('BloggerAdminBundle:Blog:form.html.twig', array(
            'blog' => $blog,
            'form' => $form->createView(),
            'create' => true
        ));
    }

    public function editBlogAction($blogId) {
        return $this->render('BloggerAdminBundle:Blog:edit.html.twig', array(
            'blogId' => $blogId
        ));
    }

    public function editAction($blogId)
    {
        $em = $this->getDoctrine()
            ->getManager();
        $blog = $em->getRepository('BloggerBlogBundle:Blog')->find($blogId);

        if (!$blog) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }

        $form  = $this->createForm(new BlogType(), $blog);

        return $this->render('BloggerAdminBundle:Blog:form.html.twig', array(
            'blog' => $blog,
            'form' => $form->createView(),
            'create' => false
        ));
    }

    public function submitEditionAction(Request $request, $blogId)
    {
        $em = $this->getDoctrine()
            ->getManager();
        $blog = $em->getRepository('BloggerBlogBundle:Blog')->find($blogId);

        $form  = $this->createForm(new BlogType(), $blog);
        $form->submit($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()
                ->getManager();
            $em->persist($blog);
            $em->flush();

            return $this->redirect($this->generateUrl('BloggerAdminBundle_homepage'));
        }

        return $this->render('BloggerAdminBundle:Blog:form.html.twig', array(
            'blog' => $blog,
            'form' => $form->createView(),
            'create' => false
        ));
    }

    public function deleteAction($blogId)
    {
        $em = $this->getDoctrine()
            ->getManager();
        $blog = $em->getRepository('BloggerBlogBundle:Blog')->find($blogId);

        if (!$blog) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }

        //use onDelete attribute (Database-level) in @JoinColumn
        foreach ($blog->getComments() AS $comment) {
            $em->remove($comment);
        }

        $em->remove($blog);
        $em->flush();

        return $this->redirect($this->generateUrl('BloggerAdminBundle_homepage'));
    }
}
