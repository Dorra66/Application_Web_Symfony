<?php

namespace MuseumBundle\Repository;

use MuseumBundle\Entity\Monument;
use UserBundle\Entity\User;

/**
 * MonumentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MonumentRepository extends \Doctrine\ORM\EntityRepository
{
    public function findEntitiesByString($str){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT m
                FROM MuseumBundle:Monument m
                WHERE m.nomm LIKE :str'
            )
            ->setParameter('str', '%'.$str.'%')
            ->getResult();
    }

}