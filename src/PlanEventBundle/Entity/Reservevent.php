<?php

namespace PlanEventBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservevent
 *
 * @ORM\Table(name="reservevent")
 * @ORM\Entity(repositoryClass="PlanEventBundle\Repository\ReserveventRepository")
 */
class Reservevent
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IdReserv", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreserv;

    /**
     * @var string
     *
     * @ORM\Column(name="NomOrg", type="string", length=50, nullable=false)
     */
    private $nomorg;

    /**
     * @var string
     *
     * @ORM\Column(name="PrenomOrg", type="string", length=50, nullable=false)
     */
    private $prenomorg;

    /**
     * @var integer
     *
     * @ORM\Column(name="TelOrg", type="integer", nullable=false)
     * @Assert\NotBlank
     * @Assert\Length(min=8 , max=8 )
     */
    private $telorg;

    /**
     * @var string
     *
     * @ORM\Column(name="MailOrg", type="string", length=50, nullable=false)
     */
    private $mailorg;

    /**
     * @var string
     *
     * @ORM\Column(name="CategorieReserv", type="string", length=50, nullable=false)
     */
    private $categoriereserv;

    /**
     * @var string
     *
     * @ORM\Column(name="NomReserv", type="string", length=255, nullable=false)
     */
    private $nomreserv;

    /**
     * @var integer
     *
     * @ORM\Column(name="NbrPlace", type="integer", nullable=false)
     */
    private $nbrplace;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateReserv", type="date", nullable=false)
     * @Assert\GreaterThan("today")
     */
    private $datereserv;

    /**
     * @var string
     *
     * @ORM\Column(name="Heure", type="string", length=5, nullable=false)
     */
    private $heure;

    /**
     * @var string
     *
     * @ORM\Column(name="Affiche", type="string", length=255, nullable=false)
     * @Assert\File(mimeTypes={ "image/jpeg" , "image/png"})
     */
    private $affiche;

    /**
     * @var string
     *
     * @ORM\Column(name="Etat", type="string", length=255, nullable=false)
     */
    private $etat;

    /**
     * @return int
     */
    public function getIdreserv()
    {
        return $this->idreserv;
    }

    /**
     * @param int $idreserv
     */
    public function setIdreserv($idreserv)
    {
        $this->idreserv = $idreserv;
    }

    /**
     * @return string
     */
    public function getNomorg()
    {
        return $this->nomorg;
    }

    /**
     * @param string $nomorg
     */
    public function setNomorg($nomorg)
    {
        $this->nomorg = $nomorg;
    }

    /**
     * @return string
     */
    public function getPrenomorg()
    {
        return $this->prenomorg;
    }

    /**
     * @param string $prenomorg
     */
    public function setPrenomorg($prenomorg)
    {
        $this->prenomorg = $prenomorg;
    }

    /**
     * @return int
     */
    public function getTelorg()
    {
        return $this->telorg;
    }

    /**
     * @param int $telorg
     */
    public function setTelorg($telorg)
    {
        $this->telorg = $telorg;
    }

    /**
     * @return string
     */
    public function getMailorg()
    {
        return $this->mailorg;
    }

    /**
     * @param string $mailorg
     */
    public function setMailorg($mailorg)
    {
        $this->mailorg = $mailorg;
    }

    /**
     * @return string
     */
    public function getCategoriereserv()
    {
        return $this->categoriereserv;
    }

    /**
     * @param string $categoriereserv
     */
    public function setCategoriereserv($categoriereserv)
    {
        $this->categoriereserv = $categoriereserv;
    }

    /**
     * @return string
     */
    public function getNomreserv()
    {
        return $this->nomreserv;
    }

    /**
     * @param string $nomreserv
     */
    public function setNomreserv($nomreserv)
    {
        $this->nomreserv = $nomreserv;
    }

    /**
     * @return int
     */
    public function getNbrplace()
    {
        return $this->nbrplace;
    }

    /**
     * @param int $nbrplace
     */
    public function setNbrplace($nbrplace)
    {
        $this->nbrplace = $nbrplace;
    }

    /**
     * @return \DateTime
     */
    public function getDatereserv()
    {
        return $this->datereserv;
    }

    /**
     * @param \DateTime $datereserv
     */
    public function setDatereserv($datereserv)
    {
        $this->datereserv = $datereserv;
    }

    /**
     * @return string
     */
    public function getHeure()
    {
        return $this->heure;
    }

    /**
     * @param string $heure
     */
    public function setHeure($heure)
    {
        $this->heure = $heure;
    }

    /**
     * @return string
     */
    public function getAffiche()
    {
        return $this->affiche;
    }

    /**
     * @param string $affiche
     */
    public function setAffiche($affiche)
    {
        $this->affiche = $affiche;
    }

    /**
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param string $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }


}
