<?php
// src/Blogger/BlogBundle/DataFixtures/ORM/RoleFixtures.php

namespace Blogger\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Blogger\BlogBundle\Entity\Role;

class RoleFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $role1 = new Role();
        $role1->setName('admin');
        $role1->setRole('ROLE_ADMIN');
        $manager->persist($role1);

        $role2 = new Role();
        $role2->setName('superadmin');
        $role2->setRole('ROLE_SUPER_ADMIN');
        $role2->setIsSingle(true);
        $manager->persist($role2);

        $role3 = new Role();
        $role3->setName('user');
        $role3->setRole('ROLE_USER');
        $manager->persist($role3);

        $role4 = new Role();
        $role4->setName('anonymous');
        $role4->setRole('IS_AUTHENTICATED_ANONYMOUSLY');
        $manager->persist($role4);

        $manager->flush();

        $this->addReference('admin', $role1);
        $this->addReference('superadmin', $role2);
        $this->addReference('user', $role3);
        $this->addReference('anonymous', $role4);
    }

    public function getOrder()
    {
        return 2;
    }
}