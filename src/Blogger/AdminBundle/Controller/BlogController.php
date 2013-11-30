<?php

namespace Blogger\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Blogger\BlogBundle\Entity\Blog;
use Blogger\BlogBundle\Entity\Tag;
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
        $blog->setCategory($em->getRepository('BloggerBlogBundle:Category')->getDefaultCategory());
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

            $blog = $this->setBlogTags($blog);

            $em->persist($blog);
            $em->getRepository('BloggerBlogBundle:Category')->recountBlogCountForAllCategories();
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

        $blog->setTagString($blog->getTagsAsString());
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

        $blog->setTagString($blog->getTagsAsString());
        $form  = $this->createForm(new BlogType(), $blog);
        $form->submit($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()
                ->getManager();
            $blog = $this->setBlogTags($blog);

            $em->persist($blog);
            $em->getRepository('BloggerBlogBundle:Category')->recountBlogCountForAllCategories();
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

        $em->remove($blog);
        $em->getRepository('BloggerBlogBundle:Category')->recountBlogCountForAllCategories();
        $em->flush();

        return $this->redirect($this->generateUrl('BloggerAdminBundle_homepage'));
    }

    public function setBlogTags(\Blogger\BlogBundle\Entity\Blog $blog) {
        $em = $this->getDoctrine()
            ->getManager();
        $tagRepository = $em->getRepository('BloggerBlogBundle:Tag');

        if($blog->getTags())
            $blog->getTags()->clear();
        $blogTags = array_map('trim', explode(",", $blog->getTagString()));

        foreach(array_unique($blogTags) as $tag) {
            if($tag) {
                $entity = $tagRepository->findOneByName($tag);
                if(!$entity) {
                    $entity = new Tag();
                    $entity->setName($tag);
                    $entity->setSlug($tag);

                    $em->persist($entity);
                }

                $blog->addTag($entity);
            }
        }
        return $blog;
    }
}
