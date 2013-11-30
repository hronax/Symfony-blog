<?php
// src/Blogger/BlogBundle/Controller/PostController.php

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Post controller.
 */
class PostController extends Controller
{
    /**
     * Show a post entry
     */
    public function showAction($id, $slug)
    {
        $em = $this->getDoctrine();
        $post = $em->getRepository('BloggerBlogBundle:Post')->find($id);

        if (!$post) {
            throw $this->createNotFoundException('Unable to find Post post.');
        }

        $comments = $em->getRepository('BloggerBlogBundle:Comment')
            ->getCommentsForPost($post->getId());

        return $this->render('BloggerBlogBundle:Post:show.html.twig', array(
            'post'      => $post,
            'slug'      => $slug,
            'comments'  => $comments
        ));
    }
}