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
        $form  = $this->createForm(new BlogType(), $blog);

        return $this->render('BloggerAdminBundle:Blog:form.html.twig', array(
            'blog' => $blog,
            'form' => $form->createView()
        ));
    }

    public function submitAction(Request $request)
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
            'form' => $form->createView()
        ));
    }

    public function editBlogAction($blog_id) {
        return $this->render('BloggerAdminBundle:Blog:edit.html.twig', array(
            'blog_id' => $blog_id
        ));
    }

    public function editAction($blog_id)
    {
        $em = $this->getDoctrine()
            ->getManager();
        $blog = $em->getRepository('BloggerBlogBundle:Blog')->find($blog_id);

        $form  = $this->createForm(new BlogType(), $blog);

        return $this->render('BloggerAdminBundle:Blog:form.html.twig', array(
            'blog' => $blog,
            'form' => $form->createView()
        ));
    }

    public function deleteAction($blog_id)
    {
        $em = $this->getDoctrine()
            ->getManager();
        $blog = $em->getRepository('BloggerBlogBundle:Blog')->find($blog_id);

        if (!$blog) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }

        foreach ($blog->getComments() AS $comment) {
            $em->remove($comment);
        }

        $em->remove($blog);
        $em->flush();

        return $this->redirect($this->generateUrl('BloggerAdminBundle_homepage'));
    }
}
