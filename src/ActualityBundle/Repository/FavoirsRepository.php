<?php

namespace ActualityBundle\Repository;

/**
 * FavoirsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FavoirsRepository extends \Doctrine\ORM\EntityRepository
{
    public function finduser($u){
        $qr = $this->getEntityManager()->createQuery("SELECT f, c 
        FROM ActualityBundle:Favoirs f
        INNER JOIN f.user c
        WHERE c.id = '$u'") ;
        return($qr->getResult()) ;


    }





}
