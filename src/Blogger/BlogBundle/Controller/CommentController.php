<?php
// src/Blogger/BlogBundle/Controller/CommentController.php

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Blogger\BlogBundle\Entity\Comment;
use Blogger\BlogBundle\Form\CommentType;

/**
 * Comment controller.
 */
class CommentController extends Controller
{
    public function newAction($pageId)
    {
        $post = $this->getPage($pageId);

        $comment = new Comment();
        $comment->setPage($post);
        $form   = $this->createForm(new CommentType(), $comment);

        return $this->render('BloggerBlogBundle:Comment:form.html.twig', array(
            'comment' => $comment,
            'form'   => $form->createView()
        ));
    }

    public function createAction($pageId)
    {
        $post = $this->getPage($pageId);

        $comment  = new Comment();
        $comment->setPage($post);
        $request = $this->getRequest();
        $form    = $this->createForm(new CommentType(), $comment);
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()
                ->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirect($this->generateUrl('BloggerBlogBundle_page_show', array(
                'id'    => $comment->getPage()->getId(),
                'slug'  => $comment->getPage()->getSlug())) .
                '#comment-' . $comment->getId()
            );
        }

        return $this->render('BloggerBlogBundle:Comment:new.html.twig', array(
            'comment' => $comment,
            'form'    => $form->createView()
        ));
    }

    protected function getPage($pageId)
    {
        $em = $this->getDoctrine();

        $post = $em->getRepository('BloggerBlogBundle:Post')->find($pageId);

        if (!$post) {
            throw $this->createNotFoundException('Unable to find Post post.');
        }

        return $post;
    }

}