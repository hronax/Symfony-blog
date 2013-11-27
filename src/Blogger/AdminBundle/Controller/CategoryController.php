<?php

namespace Blogger\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Blogger\BlogBundle\Entity\Category;
use Blogger\AdminBundle\Form\CategoryType;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller
{
    public function newCategoryAction() {
        return $this->render('BloggerAdminBundle:Category:new.html.twig');
    }

    public function newAction()
    {
        $category  = new Category();
        $form  = $this->createForm(new CategoryType(), $category);

        return $this->render('BloggerAdminBundle:Category:form.html.twig', array(
            'cat' => $category,
            'form' => $form->createView(),
            'create' => true
        ));
    }

    public function createAction(Request $request)
    {
        $category  = new Category();

        $form  = $this->createForm(new CategoryType(), $category);
        $form->submit($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()
                ->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirect($this->generateUrl('BloggerAdminBundle_default_category'));
        }

        return $this->render('BloggerAdminBundle:Category:form.html.twig', array(
            'cat' => $category,
            'form' => $form->createView(),
            'create' => true
        ));
    }

    public function editBlogAction($blog_id) {

    }

    public function editAction($blog_id)
    {

    }

    public function submitEditionAction(Request $request, $cat_id)
    {

    }

    public function deleteAction($blog_id)
    {

    }
}