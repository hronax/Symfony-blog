<?php

namespace Blogger\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Knp\Bundle\PaginatorBundle\KnpPaginatorBundle;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()
            ->getManager();

        $blogs = $em->getRepository('BloggerBlogBundle:Blog')
            ->getLatestBlogs();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $blogs,
            $this->get('request')->query->get('page', 1)/*page number*/,
            5/*limit per page*/
        );

        return $this->render('BloggerAdminBundle:Default:index.html.twig', array(
            'pagination' => $pagination
        ));
    }

    public function categoriesAction()
    {
        $em = $this->getDoctrine()
            ->getManager();

        $categories = $em->getRepository('BloggerBlogBundle:Category')
            ->getCategoriesList();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $categories,
            $this->get('request')->query->get('page', 1)/*page number*/,
            5/*limit per page*/
        );

        return $this->render('BloggerAdminBundle:Default:categories.html.twig', array(
            'pagination' => $pagination
        ));
    }

    public function tagsAction()
    {
        $em = $this->getDoctrine()
            ->getManager();

        $tags = $em->getRepository('BloggerBlogBundle:Tag')
            ->getTagList();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $tags,
            $this->get('request')->query->get('page', 1)/*page number*/,
            5/*limit per page*/
        );

        return $this->render('BloggerAdminBundle:Default:tags.html.twig', array(
            'pagination' => $pagination
        ));
    }

    public function sidebarAction()
    {
        return $this->render('BloggerAdminBundle:Default:sidebar.html.twig');
    }
}
