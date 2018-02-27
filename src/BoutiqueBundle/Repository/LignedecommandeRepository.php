<?php

namespace BoutiqueBundle\Repository;

/**
 * LignedecommandeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LignedecommandeRepository extends \Doctrine\ORM\EntityRepository
{

    public function findExistant($id, $userId){
        $query = $this->getEntityManager()
            ->createQuery("select i from BoutiqueBundle:Lignedecommande i WHERE (i.produitId=:id) AND (i.userId=:userId) AND (i.etat=:etat)")
            ->setParameters(array('id'=> $id, 'userId' => $userId,'etat'=>0)); //très important! parameterS
        return $query->getResult();
    }

    public function TotalAchatUser($userId)
    {
        $query = $this->getEntityManager()
            ->createQuery("select count (i.userId) from BoutiqueBundle:Lignedecommande i WHERE (i.userId=:userId)")
            ->setParameter('userId',$userId); //très important! parameterS
        return $query->getResult();
    }


    public function NonSetCartUser($userId)
    {
        $query = $this->getEntityManager()
            ->createQuery("select l from BoutiqueBundle:Lignedecommande l WHERE (l.userId=:userId) AND (l.etat=:etat)")
            ->setParameters(array('userId' => $userId,'etat'=>0));  //très important! parameterS
        return $query->getResult();
    }


}