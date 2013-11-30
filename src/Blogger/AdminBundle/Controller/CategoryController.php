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
            if($category->getSlug() == '')
                $category->setSlug($category->getName());

            $isUnique = $em->getRepository('BloggerBlogBundle:Category')->isCategorySlugUnique($category->getSlug());

            if($isUnique) {
                $em->persist($category);
                $em->flush();

                return $this->redirect($this->generateUrl('BloggerAdminBundle_default_categories'));
            }
            else {
                $this->get('session')->getFlashBag()->add(
                    'blogger-notice',
                    'Already have such category!'
                );

                return $this->redirect($this->generateUrl('BloggerAdminBundle_category_new'));
            }
        }

        return $this->render('BloggerAdminBundle:Category:form.html.twig', array(
            'cat' => $category,
            'form' => $form->createView(),
            'create' => true
        ));
    }

    public function editCategoryAction($catId) {
        return $this->render('BloggerAdminBundle:Category:edit.html.twig', array(
            'catId' => $catId
        ));
    }

    public function editAction($catId)
    {
        $em = $this->getDoctrine()
            ->getManager();
        $category = $em->getRepository('BloggerBlogBundle:Category')->find($catId);

        if (!$category) {
            throw $this->createNotFoundException('Unable to find Category.');
        }

        $form  = $this->createForm(new CategoryType(), $category);

        return $this->render('BloggerAdminBundle:Category:form.html.twig', array(
            'cat' => $category,
            'form' => $form->createView(),
            'create' => false
        ));
    }

    public function submitEditionAction(Request $request, $catId)
    {
        $em = $this->getDoctrine()
            ->getManager();
        $category = $em->getRepository('BloggerBlogBundle:Category')->find($catId);
        $form  = $this->createForm(new CategoryType(), $category);
        $form->submit($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()
                ->getManager();
            if($category->getSlug() == '')
                $category->setSlug($category->getName());

            $isUnique = $em->getRepository('BloggerBlogBundle:Category')->isCategorySlugUnique($category->getSlug());

            if($isUnique) {
                $em->persist($category);
                $em->flush();

                return $this->redirect($this->generateUrl('BloggerAdminBundle_default_categories'));
            }
            else {
                $this->get('session')->getFlashBag()->add(
                    'blogger-notice',
                    'Already have such category, edit failed!'
                );

                return $this->redirect($this->generateUrl('BloggerAdminBundle_category_edit', array(
                    'catId' => $category->getId())));
            }
        }

        return $this->render('BloggerAdminBundle:Category:form.html.twig', array(
            'cat' => $category,
            'form' => $form->createView(),
            'create' => false
        ));
    }

    public function deleteAction($catId)
    {
        $em = $this->getDoctrine()
            ->getManager();
        $category = $em->getRepository('BloggerBlogBundle:Category')->find($catId);

        if (!$category) {
            throw $this->createNotFoundException('Unable to find Category.');
        }

        foreach ($category->getBlogs() AS $blog) {
            $blog->setCategory($em->getRepository('BloggerBlogBundle:Category')->getDefaultCategory()[0]);
            $em->persist($blog);
        }

        $em->remove($category);
        $em->flush();

        return $this->redirect($this->generateUrl('BloggerAdminBundle_default_categories'));
    }
}