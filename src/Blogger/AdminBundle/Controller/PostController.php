<?php

namespace Blogger\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Blogger\BlogBundle\Entity\Post;
use Blogger\BlogBundle\Entity\Tag;
use Blogger\AdminBundle\Form\PostType;
use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
{
    public function newPostAction() {
        return $this->render('BloggerAdminBundle:Post:new.html.twig');
    }

    public function newAction()
    {
        $post  = new Post();
        $em = $this->
            getDoctrine();
        $post->setCategory($em->getRepository('BloggerBlogBundle:Category')->getDefaultCategory());
        $form  = $this->createForm(new PostType(), $post);

        return $this->render('BloggerAdminBundle:Post:form.html.twig', array(
            'post' => $post,
            'form' => $form->createView(),
            'create' => true
        ));
    }

    public function createAction(Request $request)
    {
        $post  = new Post();

        $form  = $this->createForm(new PostType(), $post);
        $form->submit($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()
                ->getManager();

            $post = $this->setPostTags($post);
            $user = $this->get('security.context')->getToken()->getUser();
            $post->setAuthor($user->getUsername());

            $em->persist($post);
            $em->getRepository('BloggerBlogBundle:Category')->recountPostCountForAllCategories();
            $em->flush();

            return $this->redirect($this->generateUrl('BloggerAdminBundle_homepage'));
        }

        return $this->render('BloggerAdminBundle:Post:form.html.twig', array(
            'post' => $post,
            'form' => $form->createView(),
            'create' => true
        ));
    }

    public function editPostAction($postId) {
        $user = $this->getUser();
        $em = $this->getDoctrine()
            ->getManager();
        $post = $em->getRepository('BloggerBlogBundle:Post')->find($postId);
        if(!($user->getId() == $post->getAuthor()->getId())) {
            throw $this->createNotFoundException('You don\'t have permission to edit this post.');
        }
        return $this->render('BloggerAdminBundle:Post:edit.html.twig', array(
            'postId' => $postId
        ));
    }

    public function editAction($postId)
    {
        $em = $this->getDoctrine()
            ->getManager();
        $post = $em->getRepository('BloggerBlogBundle:Post')->find($postId);

        if (!$post) {
            throw $this->createNotFoundException('Unable to find Post post.');
        }

        $post->setTagString($post->getTagsAsString());
        $form  = $this->createForm(new PostType(), $post);

        return $this->render('BloggerAdminBundle:Post:form.html.twig', array(
            'post' => $post,
            'form' => $form->createView(),
            'create' => false
        ));
    }

    public function submitEditionAction(Request $request, $postId)
    {
        $em = $this->getDoctrine()
            ->getManager();
        $post = $em->getRepository('BloggerBlogBundle:Post')->find($postId);

        $post->setTagString($post->getTagsAsString());
        $form  = $this->createForm(new PostType(), $post);
        $form->submit($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()
                ->getManager();
            $post = $this->setPostTags($post);

            $em->persist($post);
            $em->getRepository('BloggerBlogBundle:Category')->recountPostCountForAllCategories();
            $em->flush();

            return $this->redirect($this->generateUrl('BloggerAdminBundle_homepage'));
        }

        return $this->render('BloggerAdminBundle:Post:form.html.twig', array(
            'post' => $post,
            'form' => $form->createView(),
            'create' => false
        ));
    }

    public function deleteAction($postId)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()
            ->getManager();
        $post = $em->getRepository('BloggerBlogBundle:Post')->find($postId);
        if($user->getId() === $post->getAuthor()->getId()) {
            if (!$post) {
                throw $this->createNotFoundException('Unable to find Post post.');
            }

            $em->remove($post);
            $em->getRepository('BloggerBlogBundle:Category')->recountPostCountForAllCategories();
            $em->flush();

            return $this->redirect($this->generateUrl('BloggerAdminBundle_homepage'));
        }
        throw $this->createNotFoundException('You don\'t have permission to edit this post.');
    }

    public function setPostTags(\Blogger\BlogBundle\Entity\Post $post) {
        $em = $this->getDoctrine()
            ->getManager();
        $tagRepository = $em->getRepository('BloggerBlogBundle:Tag');

        if($post->getTags())
            $post->getTags()->clear();
        $postTags = array_map('trim', explode(",", $post->getTagString()));

        foreach(array_unique($postTags) as $tag) {
            if($tag) {
                $entity = $tagRepository->findOneByName($tag);
                if(!$entity) {
                    $entity = new Tag();
                    $entity->setName($tag);
                    $entity->setSlug($tag);

                    $em->persist($entity);
                }

                $post->addTag($entity);
            }
        }
        return $post;
    }
}
