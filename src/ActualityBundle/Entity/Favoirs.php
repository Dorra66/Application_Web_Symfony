<?php

namespace ActualityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use UserBundle\Entity\User;

/**
 * Favoirs
 *
 * @ORM\Table(name="favoirs")
 * @ORM\Entity(repositoryClass="ActualityBundle\Repository\FavoirsRepository")
 */
class Favoirs
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *@ORM\ManyToOne(targetEntity="Actualites")
     * @ORM\JoinColumn(name="actualite_id" , referencedColumnName="id")
     */
    private $actualite ;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User" )
     * @ORM\JoinColumn(name="user_id" , referencedColumnName="id")
     */
    private $user ;



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set actualite
     *
     * @param \ActualityBundle\Entity\Actualites $actualite
     *
     * @return Favoirs
     */
    public function setActualite(\ActualityBundle\Entity\Actualites $actualite = null)
    {
        $this->actualite = $actualite;

        return $this;
    }

    /**
     * Get actualite
     *
     * @return \ActualityBundle\Entity\Actualites
     */
    public function getActualite()
    {
        return $this->actualite;
    }

    /**
     * Set user
     *
     * @param UserBundle\Entity\User $user
     *
     * @return Favoirs
     */
    public function setUser(\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
