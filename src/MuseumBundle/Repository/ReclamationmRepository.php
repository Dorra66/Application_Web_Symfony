<?php

namespace MuseumBundle\Repository;

use MuseumBundle\Entity\Reclamationm;
use UserBundle\Entity\User;

/**
 * ReclamationmRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ReclamationmRepository extends \Doctrine\ORM\EntityRepository
{
    //Chercher mes réclamations (Client) :  (*:Utilisateur connecté)
    public function findMyClaims($person)
    {
        $query = $this->getEntityManager()->createQuery(" SELECT r FROM MuseumBundle:Reclamationm r WHERE r.idsource='$person'");
        return $query->getResult();
    }

}