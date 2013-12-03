<?php

namespace Blogger\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Blogger\BlogBundle\Entity\Tag;
use Blogger\AdminBundle\Form\TagType;
use Symfony\Component\HttpFoundation\Request;

class TagController extends Controller
{
    public function newTagAction() {
        return $this->render('BloggerAdminBundle:Tag:new.html.twig');
    }

    public function newAction()
    {
        $tag  = new Tag();

        $form  = $this->createForm(new TagType(), $tag);

        return $this->render('BloggerAdminBundle:Tag:form.html.twig', array(
            'tag' => $tag,
            'form' => $form->createView(),
            'create' => true
        ));
    }

    public function createAction(Request $request)
    {
        $tag  = new Tag();

        $form  = $this->createForm(new TagType(), $tag);
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()
                ->getManager();
            if($tag->getSlug() == '')
                $tag->setSlug($tag->getName());

            $isUnique = $em->getRepository('BloggerBlogBundle:Tag')->isTagUnique($tag->getName(), $tag->getSlug());

            if($isUnique) {
                $em->persist($tag);
                $em->flush();

                return $this->redirect($this->generateUrl('BloggerAdminBundle_default_tags'));
            }
            else {
                $this->get('session')->getFlashBag()->add(
                    'blogger-notice',
                    'Already have such tag!'
                );

                return $this->redirect($this->generateUrl('BloggerAdminBundle_tag_new'));
            }
        }

        return $this->render('BloggerAdminBundle:Tag:form.html.twig', array(
            'tag' => $tag,
            'form' => $form->createView(),
            'create' => true
        ));
    }

    public function editTagAction($tagId) {
        return $this->render('BloggerAdminBundle:Tag:edit.html.twig', array(
            'tagId' => $tagId
        ));
    }

    public function editAction($tagId)
    {
        $em = $this->getDoctrine()
            ->getManager();
        $tag = $em->getRepository('BloggerBlogBundle:Tag')->find($tagId);

        if (!$tag) {
            throw $this->createNotFoundException('Unable to find Tag');
        }

        $form  = $this->createForm(new TagType(), $tag);

        return $this->render('BloggerAdminBundle:Tag:form.html.twig', array(
            'tag' => $tag,
            'form' => $form->createView(),
            'create' => false
        ));
    }

    public function submitEditionAction(Request $request, $tagId)
    {
        $em = $this->getDoctrine()
            ->getManager();
        $tag = $em->getRepository('BloggerBlogBundle:Tag')->find($tagId);

        $form  = $this->createForm(new TagType(), $tag);
        $form->submit($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()
                ->getManager();
            if($tag->getSlug() == '')
                $tag->setSlug($tag->getName());

            $isUnique = $em->getRepository('BloggerBlogBundle:Tag')->isTagUnique($tag->getName(), $tag->getSlug(), $tagId);

            if($isUnique) {
                $em->persist($tag);
                $em->flush();

                return $this->redirect($this->generateUrl('BloggerAdminBundle_default_tags'));
            }
            else {
                $this->get('session')->getFlashBag()->add(
                    'blogger-notice',
                    'Already have such tag, edition failed!'
                );

                return $this->redirect($this->generateUrl('BloggerAdminBundle_tag_edit', array (
                    'tagId' => $tag->getId()
                    )
                ));
            }
        }

        return $this->render('BloggerAdminBundle:Tag:form.html.twig', array(
            'tag' => $tag,
            'form' => $form->createView(),
            'create' => false
        ));
    }

    public function deleteAction($tagId)
    {
        $em = $this->getDoctrine()
            ->getManager();
        $tag = $em->getRepository('BloggerBlogBundle:Tag')->find($tagId);

        if (!$tag) {
            throw $this->createNotFoundException('Unable to find Tag post.');
        }

        foreach ($tag->getPosts() AS $post) {
            $post->removeTag($tag);
        }

        $em->remove($tag);
        $em->flush();

        return $this->redirect($this->generateUrl('BloggerAdminBundle_default_tags'));
    }
}