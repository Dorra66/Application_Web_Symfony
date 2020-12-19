<?php

namespace PlanEventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participation
 *
 * @ORM\Table(name="participation", indexes={@ORM\Index(name="fk3", columns={"IdEvent"}), @ORM\Index(name="fk31", columns={"IdUser"})})
 * @ORM\Entity(repositoryClass="PlanEventBundle\Repository\ParticipationRepository")
 */
class Participation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IdParticipation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idparticipation;

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
     * @return int
     */
    public function getIdparticipation()
    {
        return $this->idparticipation;
    }

    /**
     * @param int $idparticipation
     */
    public function setIdparticipation($idparticipation)
    {
        $this->idparticipation = $idparticipation;
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
