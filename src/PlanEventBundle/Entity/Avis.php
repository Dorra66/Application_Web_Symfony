<?php

namespace PlanEventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Avis
 *
 * @ORM\Table(name="avis", indexes={@ORM\Index(name="fk1", columns={"IdEvent"}), @ORM\Index(name="fk30", columns={"IdUser"})})
 * @ORM\Entity(repositoryClass="PlanEventBundle\Repository\AvisRepository")
 */
class Avis
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IdAvis", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idavis;

    /**
     * @var string
     *
     * @ORM\Column(name="DescriptionAvis", type="string", length=255, nullable=false)
     */
    private $descriptionavis;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User" )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IdUser", referencedColumnName="id" )
     * })
     */
    private $iduser;

    /**
     * @var \Event
     *
     * @ORM\ManyToOne(targetEntity="Event" )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IdEvent", referencedColumnName="IdEvent" )
     * })
     */
    private $idevent;



    /**
     * Get idavis
     *
     * @return integer
     */
    public function getIdavis()
    {
        return $this->idavis;
    }

    /**
     * Set descriptionavis
     *
     * @param string $descriptionavis
     *
     * @return Avis
     */
    public function setDescriptionavis($descriptionavis)
    {
        $this->descriptionavis = $descriptionavis;

        return $this;
    }

    /**
     * Get descriptionavis
     *
     * @return string
     */
    public function getDescriptionavis()
    {
        return $this->descriptionavis;
    }



    /**
     * @return UserBundle\Entity\User
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * @param UserBundle\Entity\User $iduser

     */
    public function setIduser( \UserBundle\Entity\User $iduser)
    {
        $this->iduser = $iduser;
    }


    /**
     * @return \Event
     */
    public function getIdevent()
    {
        return $this->idevent;
    }

    /**
     * @param \Event $idevent
     */
    public function setIdevent($idevent)
    {
        $this->idevent = $idevent;
    }


}
