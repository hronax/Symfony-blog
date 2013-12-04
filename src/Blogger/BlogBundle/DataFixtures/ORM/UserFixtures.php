<?php
// src/Blogger/BlogBundle/DataFixtures/ORM/UserFixtures.php

namespace Blogger\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Blogger\BlogBundle\Entity\User;
use Blogger\BlogBundle\Service\Sha256Salted;

class UserFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setUsername('admin');
        $user1->setEmail('admin@symblog.com');
        $user1->setPassword(Sha256Salted::encodePasswordStatic('2623578', $user1->getSalt()));
        $user1
            ->addRole($manager->merge($this->getReference('superadmin')));
        $manager->persist($user1);

        $user2 = new User();
        $user2->setUsername('zhron4x');
        $user2->setEmail('zhron4x@symblog.com');
        $user2->setPassword(Sha256Salted::encodePasswordStatic('2623578', $user2->getSalt()));
        $user2
            ->addRole($manager->merge($this->getReference('admin')));
        $manager->persist($user2);

        $user3 = new User();
        $user3->setUsername('simpleuser');
        $user3->setEmail('simpleuser@symblog.com');
        $user3->setPassword(Sha256Salted::encodePasswordStatic('2623578', $user3->getSalt()));
        $user3
            ->addRole($manager->merge($this->getReference('user')));
        $manager->persist($user3);

        $manager->flush();

        $this->addReference('adminuser', $user1);
        $this->addReference('zhron4x', $user2);
        $this->addReference('simpleuser', $user3);
    }

    public function getOrder()
    {
        return 3;
    }
}