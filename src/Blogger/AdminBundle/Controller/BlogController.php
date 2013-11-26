<?php

namespace Blogger\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Blogger\BlogBundle\Entity\Blog;
use Blogger\AdminBundle\Form\BlogType;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller
{
    public function newAction()
    {
        $blog  = new Blog();
        $form  = $this->createForm(new BlogType(), $blog);

        return $this->render('BloggerAdminBundle:Blog:form.html.twig', array(
            'blog' => $blog,
            'form' => $form->createView()
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
            'form' => $form->createView()
        ));
    }

    public function editAction()
    {

    }

    public function deleteAction()
    {

    }
}
