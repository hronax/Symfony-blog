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

    public function categoriesAction()
    {
        $em = $this->getDoctrine()
            ->getManager();

        $categories = $em->getRepository('BloggerBlogBundle:Category')
            ->getCategoriesList();

        return $this->render('BloggerAdminBundle:Default:categories.html.twig', array(
            'categories' => $categories
        ));
    }

    public function tagsAction()
    {
        $em = $this->getDoctrine()
            ->getManager();

        $tags = $em->getRepository('BloggerBlogBundle:Tag')
            ->getTagList();

        return $this->render('BloggerAdminBundle:Default:tags.html.twig', array(
            'tags' => $tags
        ));
    }

    public function sidebarAction()
    {
        return $this->render('BloggerAdminBundle:Default:sidebar.html.twig');
    }
}
