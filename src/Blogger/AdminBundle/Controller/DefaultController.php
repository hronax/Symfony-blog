<?php

namespace Blogger\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()
            ->getManager();

        $posts = $em->getRepository('BloggerBlogBundle:Post')
            ->getLatestPosts();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $posts,
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
            ->getCategoriesList(true);

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

    public function usersAction()
    {
        $em = $this->getDoctrine()
            ->getManager();

        $users = $em->getRepository('BloggerBlogBundle:User')
            ->getUserList();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $users,
            $this->get('request')->query->get('page', 1)/*page number*/,
            5/*limit per page*/
        );

        return $this->render('BloggerAdminBundle:Default:users.html.twig', array(
            'pagination' => $pagination
        ));
    }

    public function sidebarAction()
    {
        return $this->render('BloggerAdminBundle:Default:sidebar.html.twig');
    }
}
