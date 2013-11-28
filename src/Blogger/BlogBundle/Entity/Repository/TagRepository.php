<?php

namespace Blogger\BlogBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * TagRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TagRepository extends EntityRepository
{
    public function getTagList()
    {
        $qb = $this->createQueryBuilder('t')
            ->select('t, b')
            ->leftJoin('t.blogs', 'b')
            ->addOrderBy('t.name', 'ASC');

        return $qb->getQuery()
            ->getResult();
    }

    public function isTagUnique($name, $slug) {
        $qb = $this->createQueryBuilder('t')
            ->select('t')
            ->where('t.slug = :slug')
            ->orWhere('t.name = :name')
            ->setParameters(
                array(
                    'slug' => $slug,
                    'name' => $name
                )
            );
        if($qb->getQuery()->getResult())
            return false;
        else
            return true;
    }

    public function getTagWeights()
    {
        $tags = $this->getTagList();
        $tagWeights = array();
        if (empty($tags))
            return $tagWeights;

        foreach ($tags as $tag)
        {
            $tagWeights[$tag->getName()] = $tag->getBlogCount();
        }
        // Shuffle the tags
        uksort($tagWeights, function() {
            return rand() > rand();
        });

        $max = max($tagWeights);

        // Max of 5 weights
        $multiplier = ($max > 5) ? 5 / $max : 1;
        foreach ($tagWeights as &$tag)
        {
            $tag = ceil($tag * $multiplier);
        }

        return $tagWeights;
    }

    public function findOneByName($name) {
        $qb = $this->createQueryBuilder('t')
            ->select('t')
            ->where('t.name = :name')
            ->setParameter('name', $name);
        $entity = $qb->getQuery()->getResult();
        if(!$entity)
            return false;
        else
            return $entity[0];
    }
}