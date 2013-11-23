<?php

namespace Blogger\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BloggerAdminBundle:Default:index.html.twig');
    }

    public function sidebarAction()
    {
        return $this->render('BloggerAdminBundle:Default:sidebar.html.twig');
    }
}
