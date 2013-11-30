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
     * @ORM\OneToMany(targetEntity="Post", mappedBy="category")
     */
    protected $posts;

    /**
     * @ORM\Column(type="integer")
     */
    protected $postCount;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     */
    protected $slug;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $parent;

    /**
     * @ORM\OneToMany(targetEntity="Category", mappedBy="parent")
     */
    protected $children;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $isDefault;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->parent = null;
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
        $this->isDefault = false;
        $this->postCount = 0;
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

    /**
     * Add posts
     *
     * @param \Blogger\BlogBundle\Entity\Post $posts
     * @return Category
     */
    public function addPost(\Blogger\BlogBundle\Entity\Post $posts)
    {
        $this->posts[] = $posts;
    
        return $this;
    }

    /**
     * Remove posts
     *
     * @param \Blogger\BlogBundle\Entity\Post $posts
     */
    public function removePost(\Blogger\BlogBundle\Entity\Post $posts)
    {
        $this->posts->removeElement($posts);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPosts()
    {
        return $this->posts;
    }

    public function __toString()
    {
        return $this->getName();
    }

    public function setTableDefinition()
    {
        $this->hasColumn('name', 'string', 255);
    }

    public function setUp()
    {
        $options = array(
            'hasManyRoots'   => true,
            'rootColumnName' => 'root_id'
        );
        $this->actAs('NestedSet', $options);
    }

    /**
     * Set parent
     *
     * @param \Blogger\BlogBundle\Entity\Category $parent
     * @return Category
     */
    public function setParent(\Blogger\BlogBundle\Entity\Category $parent = null)
    {
        $this->parent = $parent;
    
        return $this;
    }

    /**
     * Get parent
     *
     * @return \Blogger\BlogBundle\Entity\Category 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add children
     *
     * @param \Blogger\BlogBundle\Entity\Category $children
     * @return Category
     */
    public function addChildren(\Blogger\BlogBundle\Entity\Category $children)
    {
        $this->children[] = $children;
    
        return $this;
    }

    /**
     * Remove children
     *
     * @param \Blogger\BlogBundle\Entity\Category $children
     */
    public function removeChildren(\Blogger\BlogBundle\Entity\Category $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }

    public function getPostCount($onlyPublic = true)
    {
        if ($onlyPublic)
            return $this->postCount;
        return $this->posts->count();
    }

    /**
     * Set postCount
     *
     * @param integer $postCount
     * @return Category
     */
    public function setPostCount($postCount)
    {
        $this->postCount = $postCount;
    
        return $this;
    }
}