<?php

namespace Blogger\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Blogger\BlogBundle\Entity\User;
use Blogger\AdminBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function newUserAction() {
        return $this->render('BloggerAdminBundle:User:new.html.twig');
    }

    public function newAction()
    {
        $user  = new User();

        $form  = $this->createForm(new UserType(), $user);

        return $this->render('BloggerAdminBundle:User:form.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
            'create' => true
        ));
    }

    public function createAction(Request $request)
    {
        $user  = new User();

        $form  = $this->createForm(new UserType(), $user);
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()
                ->getManager();


            $isUnique = $em->getRepository('BloggerBlogBundle:User')->isUserUnique($user->getUsername(), $user->getEmail());

            if($isUnique) {
                $encoder = $this->container->get('blogger.blog.sha256salted_encoder');
                $password = $encoder->encodePassword('MyPass', $user->getSalt());
                $user->setPassword($password);
                $role = $em->getRepository('BloggerBlogBundle:Role')->findByName('user');
                $user->addRole($role);
                $em->persist($user);
                $em->flush();

                return $this->redirect($this->generateUrl('BloggerAdminBundle_default_users'));
            }
            else {
                $this->get('session')->getFlashBag()->add(
                    'blogger-notice',
                    'Already have such user!'
                );

                return $this->redirect($this->generateUrl('BloggerAdminBundle_user_new'));
            }
        }

        return $this->render('BloggerAdminBundle:User:form.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
            'create' => true
        ));
    }

    public function editUserAction($userId) {
        return $this->render('BloggerAdminBundle:User:edit.html.twig', array(
            'userId' => $userId
        ));
    }

    public function editAction($userId)
    {
        $em = $this->getDoctrine()
            ->getManager();
        $user = $em->getRepository('BloggerBlogBundle:User')->find($userId);

        if (!$user) {
            throw $this->createNotFoundException('Unable to find User');
        }

        $form  = $this->createForm(new UserType(), $user);

        return $this->render('BloggerAdminBundle:User:form.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
            'create' => false
        ));
    }

    public function submitEditionAction(Request $request, $userId)
    {
        $em = $this->getDoctrine()
            ->getManager();
        $user = $em->getRepository('BloggerBlogBundle:User')->find($userId);

        $form  = $this->createForm(new UserType(), $user);
        $form->submit($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()
                ->getManager();

            $isUnique = $em->getRepository('BloggerBlogBundle:User')->isUserUnique($user->getUsername(), $user->getEmail(), $userId);

            if($isUnique) {
                $em->persist($user);
                $em->flush();

                return $this->redirect($this->generateUrl('BloggerAdminBundle_default_users'));
            }
            else {
                $this->get('session')->getFlashBag()->add(
                    'blogger-notice',
                    'Already have such user, edition failed!'
                );

                return $this->redirect($this->generateUrl('BloggerAdminBundle_user_edit', array (
                        'userId' => $user->getId()
                    )
                ));
            }
        }

        return $this->render('BloggerAdminBundle:User:form.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
            'create' => false
        ));
    }

    public function deleteAction($userId)
    {
        $em = $this->getDoctrine()
            ->getManager();
        $user = $em->getRepository('BloggerBlogBundle:User')->find($userId);

        if (!$user) {
            throw $this->createNotFoundException('Unable to find User post.');
        }

        $em->remove($user);
        $em->flush();

        return $this->redirect($this->generateUrl('BloggerAdminBundle_default_users'));
    }
}