<?php

namespace Blogger\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()
            ->getManager();

        $blogs = $em->getRepository('BloggerBlogBundle:Blog')
            ->getLatestBlogs();

        return $this->render('BloggerAdminBundle:Default:index.html.twig', array(
            'blogs' => $blogs
        ));
    }

    public function sidebarAction()
    {
        return $this->render('BloggerAdminBundle:Default:sidebar.html.twig');
    }
}
