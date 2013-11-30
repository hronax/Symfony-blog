<?php
// src/Blogger/BlogBundle/DataFixtures/ORM/CategoryFixtures.php

namespace Blogger\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Blogger\BlogBundle\Entity\Category;

class CategoryFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $category1 = new Category();
        $category1->setIsDefault(1);
        $category1->setName('News');
        $category1->setSlug('news');
        $manager->persist($category1);

        $category2 = new Category();
        $category2->setIsDefault(0);
        $category2->setName('Music');
        $category2->setSlug('music');
        $manager->persist($category2);

        $category3 = new Category();
        $category3->setIsDefault(0);
        $category3->setName('Cars');
        $category3->setSlug('cars');
        $manager->persist($category3);

        $category4 = new Category();
        $category4->setIsDefault(0);
        $category4->setName('Pictures');
        $category4->setSlug('pictures');
        $manager->persist($category4);

        $category5 = new Category();
        $category5->setIsDefault(0);
        $category5->setName('Lyrics');
        $category5->setSlug('lyrics');
        $manager->persist($category5);

        $manager->flush();

        $this->addReference('category-1', $category1);
        $this->addReference('category-2', $category2);
        $this->addReference('category-3', $category3);
        $this->addReference('category-4', $category4);
        $this->addReference('category-5', $category5);
    }

    public function getOrder()
    {
        return 1;
    }
}