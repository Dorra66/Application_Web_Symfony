<?php


namespace LibraryBundle\Repository;


class UserRequestRepository extends \Doctrine\ORM\EntityRepository
{

    public function findEmail($useremail)
    {
        $req=$this->getEntityManager();
        return  $req->createQuery("SELECT ur FROM LibraryBundle:Userrequest ur WHERE ur.memberemail LIKE :s ")
            ->setParameter('s',$useremail.'%')
            ->getResult();
    }

    public function updateState($id)
    {
        $q = $this->getEntityManager()->createQuery("UPDATE LibraryBundle:Userrequest ur SET ur.requeststate='Confirmed' WHERE ur.idrequest='$id'");
        return $q->getResult();
    }

}