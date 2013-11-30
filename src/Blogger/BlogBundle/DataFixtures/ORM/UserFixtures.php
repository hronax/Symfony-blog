<?php
// src/Blogger/BlogBundle/DataFixtures/ORM/UserFixtures.php

namespace Blogger\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Blogger\BlogBundle\Entity\User;

class UserFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setUsername('admin');
        $user1->setEmail('admin@symblog.com');
        $user1->setPassword('2623578');
        $user1
            ->addRole($manager->merge($this->getReference('superadmin')));
        $manager->persist($user1);

        $manager->getRepository('BloggerBlogBundle:Category')->recountPostCountForAllCategories();
        $manager->flush();
    }

    public function getOrder()
    {
        return 6;
    }
}