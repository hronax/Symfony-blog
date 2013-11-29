<?php
namespace Blogger\BlogBundle\Entity;

use Blogger\BlogBundle\HelpTools\HelpTools;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Console\Helper\Helper;

/**
 * @ORM\Entity(repositoryClass="Blogger\BlogBundle\Entity\Repository\CategoryRepository")
 * @ORM\Table(name="category")
 * @ORM\HasLifecycleCallbacks()
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Blog", mappedBy="category")
     */
    protected $blogs;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     */
    protected $slug;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $isDefault;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->blogs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->isDefault = false;
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Category
     */
    public function setSlug($slug)
    {
        $this->slug = HelpTools::slugify($slug);
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set default
     *
     * @param boolean $default
     * @return Category
     */
    public function setIsDefault($isDefault)
    {
        $this->isDefault = $isDefault;
    
        return $this;
    }

    /**
     * Get default
     *
     * @return boolean 
     */
    public function getIsDefault()
    {
        return $this->isDefault;
    }

    public function getBlogCount()
    {
            return $this->blogs->count();
    }

    public function getPostedBlogCount() {
        $postedBlogCount = 0;
        foreach($this->blogs as $blog) {
            if($blog->getPosted() == 1)
                $postedBlogCount++;
        }
        return $postedBlogCount;
    }

    /**
     * Add blogs
     *
     * @param \Blogger\BlogBundle\Entity\Blog $blogs
     * @return Category
     */
    public function addBlog(\Blogger\BlogBundle\Entity\Blog $blogs)
    {
        $this->blogs[] = $blogs;
    
        return $this;
    }

    /**
     * Remove blogs
     *
     * @param \Blogger\BlogBundle\Entity\Blog $blogs
     */
    public function removeBlog(\Blogger\BlogBundle\Entity\Blog $blogs)
    {
        $this->blogs->removeElement($blogs);
    }

    /**
     * Get blogs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBlogs()
    {
        return $this->blogs;
    }

    public function __toString()
    {
        return $this->getName();
    }
}