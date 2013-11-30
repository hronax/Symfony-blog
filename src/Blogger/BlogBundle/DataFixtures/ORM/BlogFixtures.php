<?php
// src/Blogger/BlogBundle/DataFixtures/ORM/BlogFixtures.php

namespace Blogger\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Blogger\BlogBundle\Entity\Blog;

class BlogFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $blog1 = new Blog();
        $blog1->setTitle('A day with Symfony2');
        $blog1->setBlog('Lorem ipsum dolor sit amet, consectetur adipiscing eletra electrify denim vel ports.\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ut velocity magna. Etiam vehicula nunc non leo hendrerit commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras el mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras elementum molestie vestibulum. Morbi id quam nisl. Praesent hendrerit, orci sed elementum lobortis, justo mauris lacinia libero, non facilisis purus ipsum non mi. Aliquam sollicitudin, augue id vestibulum iaculis, sem lectus convallis nunc, vel scelerisque lorem tortor ac nunc. Donec pharetra eleifend enim vel porta.');
        $blog1->setImage('beach.jpg');
        $blog1->setAuthor('dsyph3r');
        $blog1->setCategory($manager->merge($this->getReference('category-1')));
        $blog1->addTag($this->getReference('tag-1'))->addTag($this->getReference('tag-2'));
        $blog1->setCreated(new \DateTime());
        $blog1->setUpdated($blog1->getCreated());
        $blog1->setPosted(true);
        $manager->persist($blog1);

        $blog2 = new Blog();
        $blog2->setTitle('The pool on the roof must have a leak');
        $blog2->setBlog('Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Na. Cras elementum molestie vestibulum. Morbi id quam nisl. Praesent hendrerit, orci sed elementum lobortis.');
        $blog2->setImage('pool_leak.jpg');
        $blog2->setAuthor('Zero Cool');
        $blog2->setCategory($manager->merge($this->getReference('category-2')));
        $blog2->addTag($this->getReference('tag-3'))->addTag($this->getReference('tag-4'));
        $blog2->setCreated(new \DateTime("2011-07-23 06:12:33"));
        $blog2->setUpdated($blog2->getCreated());
        $blog2->setPosted(true);
        $manager->persist($blog2);

        $blog3 = new Blog();
        $blog3->setTitle('Misdirection. What the eyes see and the ears hear, the mind believes');
        $blog3->setBlog('Lorem ipsumvehicula nunc non leo hendrerit commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque.');
        $blog3->setImage('misdirection.jpg');
        $blog3->setAuthor('Gabriel');
        $blog3->setCategory($manager->merge($this->getReference('category-3')));
        $blog3->addTag($this->getReference('tag-1'))->addTag($this->getReference('tag-5'));
        $blog3->setCreated(new \DateTime("2011-07-16 16:14:06"));
        $blog3->setUpdated($blog3->getCreated());
        $blog3->setPosted(true);
        $manager->persist($blog3);

        $blog4 = new Blog();
        $blog4->setTitle('The grid - A digital frontier');
        $blog4->setBlog('Lorem commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra.');
        $blog4->setImage('the_grid.jpg');
        $blog4->setAuthor('Kevin Flynn');
        $blog4->setCategory($manager->merge($this->getReference('category-5')));
        $blog4->addTag($this->getReference('tag-6'))->addTag($this->getReference('tag-8'));
        $blog4->setCreated(new \DateTime("2011-06-02 18:54:12"));
        $blog4->setUpdated($blog4->getCreated());
        $blog4->setPosted(false);
        $manager->persist($blog4);

        $blog5 = new Blog();
        $blog5->setTitle('You\'re either a one or a zero. Alive or dead');
        $blog5->setBlog('Lorem ipsum dolor sit amet, consectetur adipiscing elittibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque.');
        $blog5->setImage('one_or_zero.jpg');
        $blog5->setAuthor('Gary Winston');
        $blog5->setCategory($manager->merge($this->getReference('category-1')));
        $blog5->addTag($this->getReference('tag-1'))->addTag($this->getReference('tag-4'));
        $blog5->setCreated(new \DateTime("2011-04-25 15:34:18"));
        $blog5->setUpdated($blog5->getCreated());
        $blog5->setPosted(true);
        $manager->persist($blog5);

        $blog6 = new Blog();
        $blog6->setTitle('Installing and Configuring Symfony (current) - Symfony');
        $blog6->setBlog('Composer is a dependency management library for PHP, which you can use to ... libraries or bundles and managing them via Composer, you should probably  ...');
        $blog6->setImage('beach.jpg');
        $blog6->setAuthor('dsyph3r');
        $blog6->setCategory($manager->merge($this->getReference('category-1')));
        $blog6->addTag($this->getReference('tag-1'))->addTag($this->getReference('tag-2'));
        $blog6->setCreated(new \DateTime());
        $blog6->setUpdated($blog6->getCreated());
        $blog6->setPosted(true);
        $manager->persist($blog6);

        $blog7 = new Blog();
        $blog7->setTitle('The pool on the roof must have a leak');
        $blog7->setBlog('Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Na. Cras elementum molestie vestibulum. Morbi id quam nisl. Praesent hendrerit, orci sed elementum lobortis.');
        $blog7->setImage('default.png');
        $blog7->setAuthor('Zero Cool');
        $blog7->setCategory($manager->merge($this->getReference('category-2')));
        $blog7->addTag($this->getReference('tag-3'))->addTag($this->getReference('tag-4'));
        $blog7->setCreated(new \DateTime("2011-07-23 06:12:33"));
        $blog7->setUpdated($blog7->getCreated());
        $blog7->setPosted(true);
        $manager->persist($blog7);

        $blog8 = new Blog();
        $blog8->setTitle('Misdirection. What the eyes see and the ears hear, the mind believes');
        $blog8->setBlog('Lorem ipsumvehicula nunc non leo hendrerit commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque.');
        $blog8->setImage('misdirection.jpg');
        $blog8->setAuthor('Gabriel');
        $blog8->setCategory($manager->merge($this->getReference('category-5')));
        $blog8->addTag($this->getReference('tag-1'))->addTag($this->getReference('tag-5'));
        $blog8->setCreated(new \DateTime("2011-07-16 16:14:06"));
        $blog8->setUpdated($blog8->getCreated());
        $blog8->setPosted(true);
        $manager->persist($blog8);

        $blog9 = new Blog();
        $blog9->setTitle('The grid - A digital frontier');
        $blog9->setBlog('Lorem commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra.');
        $blog9->setImage('default.png');
        $blog9->setAuthor('Kevin Flynn');
        $blog9->setCategory($manager->merge($this->getReference('category-5')));
        $blog9->addTag($this->getReference('tag-6'))->addTag($this->getReference('tag-8'));
        $blog9->setCreated(new \DateTime("2011-06-02 18:54:12"));
        $blog9->setUpdated($blog9->getCreated());
        $blog9->setPosted(false);
        $manager->persist($blog9);

        $blog10 = new Blog();
        $blog10->setTitle('You\'re either a one or a zero. Alive or dead');
        $blog10->setBlog('Lorem ipsum dolor sit amet, consectetur adipiscing elittibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque.');
        $blog10->setImage('one_or_zero.jpg');
        $blog10->setAuthor('Gary Winston');
        $blog10->setCategory($manager->merge($this->getReference('category-1')));
        $blog10->addTag($this->getReference('tag-1'))->addTag($this->getReference('tag-4'));
        $blog10->setCreated(new \DateTime("2011-04-25 15:34:18"));
        $blog10->setUpdated($blog10->getCreated());
        $blog10->setPosted(true);
        $manager->persist($blog10);

        $manager->flush();

        $this->addReference('blog-1', $blog1);
        $this->addReference('blog-2', $blog2);
        $this->addReference('blog-3', $blog8);
        $this->addReference('blog-4', $blog4);
        $this->addReference('blog-5', $blog5);
        $this->addReference('blog-6', $blog6);
        $this->addReference('blog-7', $blog7);
        $this->addReference('blog-8', $blog8);
        $this->addReference('blog-9', $blog9);
        $this->addReference('blog-10', $blog10);
    }

    public function getOrder()
    {
        return 3;
    }
}