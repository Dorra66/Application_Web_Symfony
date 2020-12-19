<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use UserBundle\Entity\User;
use UserBundle\Controller\DefaultController;

/**
 * Panier
 *
 * @ORM\Table(name="panier")
 * @ORM\Entity
 */
class Panier
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
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="client", referencedColumnName="id",onDelete="CASCADE")
     * })
     */
    private $user;


    /**
     * @var \AnnonceProd
     *
     * @ORM\ManyToOne(targetEntity="AnnonceProd")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="produit", referencedColumnName="id_prod",onDelete="CASCADE")
     * })
     */

    private $produit;


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
     * @return \User
     */

    public function getUser()
    {
        return $this->user;
    }
    /**
     * @param \User $user
     */

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return \AnnonceProd
     */
    public function getProduit()
    {
        return $this->produit;
    }
    /**
     * @param \AnnonceProd $produit
     */

    public function setProduit(AnnonceProd $produit)
    {
        $this->produit = $produit;
    }



}

