<?php

namespace gestionsanteBundle\Repository;

/**
 * ArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticleRepository extends \Doctrine\ORM\EntityRepository
{
    public function findTrierDQL()
    {
        $query=$this->getEntityManager()->createQuery("SELECT m FROM gestionsanteBundle:Article m ORDER BY m.rating DESC ");
        return $query->getResult();
    }

    public function findTrierVuesDQL()
    {
        $query=$this->getEntityManager()->createQuery("SELECT m FROM gestionsanteBundle:Article m ORDER BY m.vues DESC ");
        return $query->getResult();
    }
}
