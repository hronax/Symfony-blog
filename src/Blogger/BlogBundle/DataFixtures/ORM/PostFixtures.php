<?php
// src/Blogger/BlogBundle/DataFixtures/ORM/PostFixtures.php

namespace Blogger\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Blogger\BlogBundle\Entity\Post;

class PostFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $post1 = new Post();
        $post1->setTitle('A day with Symfony2');
        $post1->setPost('Lorem ipsum dolor sit amet, consectetur adipiscing eletra electrify denim vel ports.\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ut velocity magna. Etiam vehicula nunc non leo hendrerit commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras el mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras elementum molestie vestibulum. Morbi id quam nisl. Praesent hendrerit, orci sed elementum lobortis, justo mauris lacinia libero, non facilisis purus ipsum non mi. Aliquam sollicitudin, augue id vestibulum iaculis, sem lectus convallis nunc, vel scelerisque lorem tortor ac nunc. Donec pharetra eleifend enim vel porta.');
        $post1->setImage('beach.jpg');
        $post1->setAuthor($manager->merge($this->getReference('adminuser')));
        $post1->setCategory($manager->merge($this->getReference('category-1')));
        $post1->addTag($this->getReference('tag-1'))->addTag($this->getReference('tag-2'));
        $post1->setCreated(new \DateTime());
        $post1->setUpdated($post1->getCreated());
        $post1->setPosted(true);
        $manager->persist($post1);

        $post2 = new Post();
        $post2->setTitle('The pool on the roof must have a leak');
        $post2->setPost('Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Na. Cras elementum molestie vestibulum. Morbi id quam nisl. Praesent hendrerit, orci sed elementum lobortis.');
        $post2->setImage('pool_leak.jpg');
        $post2->setAuthor($manager->merge($this->getReference('zhron4x')));
        $post2->setCategory($manager->merge($this->getReference('category-2')));
        $post2->addTag($this->getReference('tag-3'))->addTag($this->getReference('tag-4'));
        $post2->setCreated(new \DateTime("2011-07-23 06:12:33"));
        $post2->setUpdated($post2->getCreated());
        $post2->setPosted(true);
        $manager->persist($post2);

        $post3 = new Post();
        $post3->setTitle('Misdirection. What the eyes see and the ears hear, the mind believes');
        $post3->setPost('Lorem ipsumvehicula nunc non leo hendrerit commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque.');
        $post3->setImage('misdirection.jpg');
        $post3->setAuthor($manager->merge($this->getReference('simpleuser')));
        $post3->setCategory($manager->merge($this->getReference('category-3')));
        $post3->addTag($this->getReference('tag-1'))->addTag($this->getReference('tag-5'));
        $post3->setCreated(new \DateTime("2011-07-16 16:14:06"));
        $post3->setUpdated($post3->getCreated());
        $post3->setPosted(true);
        $manager->persist($post3);

        $post4 = new Post();
        $post4->setTitle('The grid - A digital frontier');
        $post4->setPost('Lorem commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra.');
        $post4->setImage('the_grid.jpg');
        $post4->setAuthor($manager->merge($this->getReference('adminuser')));
        $post4->setCategory($manager->merge($this->getReference('category-5')));
        $post4->addTag($this->getReference('tag-6'))->addTag($this->getReference('tag-8'));
        $post4->setCreated(new \DateTime("2011-06-02 18:54:12"));
        $post4->setUpdated($post4->getCreated());
        $post4->setPosted(false);
        $manager->persist($post4);

        $post5 = new Post();
        $post5->setTitle('You\'re either a one or a zero. Alive or dead');
        $post5->setPost('Lorem ipsum dolor sit amet, consectetur adipiscing elittibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque.');
        $post5->setImage('one_or_zero.jpg');
        $post5->setAuthor($manager->merge($this->getReference('simpleuser')));
        $post5->setCategory($manager->merge($this->getReference('category-1')));
        $post5->addTag($this->getReference('tag-1'))->addTag($this->getReference('tag-4'));
        $post5->setCreated(new \DateTime("2011-04-25 15:34:18"));
        $post5->setUpdated($post5->getCreated());
        $post5->setPosted(true);
        $manager->persist($post5);

        $post6 = new Post();
        $post6->setTitle('Installing and Configuring Symfony (current) - Symfony');
        $post6->setPost('Composer is a dependency management library for PHP, which you can use to ... libraries or bundles and managing them via Composer, you should probably  ...');
        $post6->setImage('beach.jpg');
        $post6->setAuthor($manager->merge($this->getReference('zhron4x')));
        $post6->setCategory($manager->merge($this->getReference('category-1')));
        $post6->addTag($this->getReference('tag-1'))->addTag($this->getReference('tag-2'));
        $post6->setCreated(new \DateTime());
        $post6->setUpdated($post6->getCreated());
        $post6->setPosted(true);
        $manager->persist($post6);

        $post7 = new Post();
        $post7->setTitle('The pool on the roof must have a leak');
        $post7->setPost('Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Na. Cras elementum molestie vestibulum. Morbi id quam nisl. Praesent hendrerit, orci sed elementum lobortis.');
        $post7->setImage('default.png');
        $post7->setAuthor($manager->merge($this->getReference('adminuser')));
        $post7->setCategory($manager->merge($this->getReference('category-2')));
        $post7->addTag($this->getReference('tag-3'))->addTag($this->getReference('tag-4'));
        $post7->setCreated(new \DateTime("2011-07-23 06:12:33"));
        $post7->setUpdated($post7->getCreated());
        $post7->setPosted(true);
        $manager->persist($post7);

        $post8 = new Post();
        $post8->setTitle('Misdirection. What the eyes see and the ears hear, the mind believes');
        $post8->setPost('Lorem ipsumvehicula nunc non leo hendrerit commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque.');
        $post8->setImage('misdirection.jpg');
        $post8->setAuthor($manager->merge($this->getReference('adminuser')));
        $post8->setCategory($manager->merge($this->getReference('category-5')));
        $post8->addTag($this->getReference('tag-1'))->addTag($this->getReference('tag-5'));
        $post8->setCreated(new \DateTime("2011-07-16 16:14:06"));
        $post8->setUpdated($post8->getCreated());
        $post8->setPosted(true);
        $manager->persist($post8);

        $post9 = new Post();
        $post9->setTitle('The grid - A digital frontier');
        $post9->setPost('Lorem commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra.');
        $post9->setImage('default.png');
        $post9->setAuthor($manager->merge($this->getReference('zhron4x')));
        $post9->setCategory($manager->merge($this->getReference('category-5')));
        $post9->addTag($this->getReference('tag-6'))->addTag($this->getReference('tag-8'));
        $post9->setCreated(new \DateTime("2011-06-02 18:54:12"));
        $post9->setUpdated($post9->getCreated());
        $post9->setPosted(false);
        $manager->persist($post9);

        $post10 = new Post();
        $post10->setTitle('You\'re either a one or a zero. Alive or dead');
        $post10->setPost('Lorem ipsum dolor sit amet, consectetur adipiscing elittibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque.');
        $post10->setImage('one_or_zero.jpg');
        $post10->setAuthor($manager->merge($this->getReference('simpleuser')));
        $post10->setCategory($manager->merge($this->getReference('category-1')));
        $post10->addTag($this->getReference('tag-1'))->addTag($this->getReference('tag-4'));
        $post10->setCreated(new \DateTime("2011-04-25 15:34:18"));
        $post10->setUpdated($post10->getCreated());
        $post10->setPosted(true);
        $manager->persist($post10);

        $manager->flush();

        $this->addReference('post-1', $post1);
        $this->addReference('post-2', $post2);
        $this->addReference('post-3', $post8);
        $this->addReference('post-4', $post4);
        $this->addReference('post-5', $post5);
        $this->addReference('post-6', $post6);
        $this->addReference('post-7', $post7);
        $this->addReference('post-8', $post8);
        $this->addReference('post-9', $post9);
        $this->addReference('post-10', $post10);
    }

    public function getOrder()
    {
        return 5;
    }
}