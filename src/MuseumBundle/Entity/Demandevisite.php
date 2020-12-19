<?php

namespace MuseumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Demandevisite
 *
 * @ORM\Table(name="demandevisite")
 * @ORM\Entity(repositoryClass="MuseumBundle\Repository\DemandevisiteRepository")
 */
class Demandevisite
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idDV", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddv;

    /**
     * @var string
     *
     * @ORM\Column(name="Source", type="string", length=30, nullable=false)
     */
    private $source;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="nomOrganismeD", type="string", length=100, nullable=false)
     */
    private $nomorganismed;

    /**
     * @var string
     *
     * @ORM\Column(name="nomResponsableD", type="string", length=70, nullable=false)
     */
    private $nomresponsabled;

    /**
     * @var integer
     * @Assert\Length(min=8, max=8)
     * @ORM\Column(name="numTelD", type="integer", nullable=false)
     */
    private $numteld;

    /**
     * @var string
     *
     * @ORM\Column(name="mailD", type="string", length=150, nullable=false)
     */
    private $maild;

    /**
     * @var string
     *
     * @ORM\Column(name="addPostaleD", type="string", length=150, nullable=false)
     */
    private $addpostaled;

    /**
     * @var \DateTime
     * @Assert\GreaterThan("today")
     * @ORM\Column(name="dateVisiteD", type="date", nullable=false)
     */
    private $datevisited;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="heureVisiteD", type="string", length=10, nullable=false)
     */
    private $heurevisited;

    /**
     * @var integer
     * @Assert\Range(min=1, max=50)
     * @ORM\Column(name="nbreVisiteursD", type="integer", nullable=false)
     */
    private $nbrevisiteursd;

    /**
     * @var string
     *
     * @ORM\Column(name="etatDV", type="string", length=30, nullable=false)
     */
    private $etatdv;

    /**
     * @return int
     */
    public function getIddv()
    {
        return $this->iddv;
    }

    /**
     * @param int $iddv
     */
    public function setIddv($iddv)
    {
        $this->iddv = $iddv;
    }

    /**
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param string $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * @return string
     */
    public function getNomorganismed()
    {
        return $this->nomorganismed;
    }

    /**
     * @param string $nomorganismed
     */
    public function setNomorganismed($nomorganismed)
    {
        $this->nomorganismed = $nomorganismed;
    }

    /**
     * @return string
     */
    public function getNomresponsabled()
    {
        return $this->nomresponsabled;
    }

    /**
     * @param string $nomresponsabled
     */
    public function setNomresponsabled($nomresponsabled)
    {
        $this->nomresponsabled = $nomresponsabled;
    }

    /**
     * @return int
     */
    public function getNumteld()
    {
        return $this->numteld;
    }

    /**
     * @param int $numteld
     */
    public function setNumteld($numteld)
    {
        $this->numteld = $numteld;
    }

    /**
     * @return string
     */
    public function getMaild()
    {
        return $this->maild;
    }

    /**
     * @param string $maild
     */
    public function setMaild($maild)
    {
        $this->maild = $maild;
    }

    /**
     * @return string
     */
    public function getAddpostaled()
    {
        return $this->addpostaled;
    }

    /**
     * @param string $addpostaled
     */
    public function setAddpostaled($addpostaled)
    {
        $this->addpostaled = $addpostaled;
    }

    /**
     * @return \DateTime
     */
    public function getDatevisited()
    {
        return $this->datevisited;
    }

    /**
     * @param \DateTime $datevisited
     */
    public function setDatevisited($datevisited)
    {
        $this->datevisited = $datevisited;
    }

    /**
     * @return string
     */
    public function getHeurevisited()
    {
        return $this->heurevisited;
    }

    /**
     * @param string $heurevisited
     */
    public function setHeurevisited($heurevisited)
    {
        $this->heurevisited = $heurevisited;
    }

    /**
     * @return int
     */
    public function getNbrevisiteursd()
    {
        return $this->nbrevisiteursd;
    }

    /**
     * @param int $nbrevisiteursd
     */
    public function setNbrevisiteursd($nbrevisiteursd)
    {
        $this->nbrevisiteursd = $nbrevisiteursd;
    }

    /**
     * @return string
     */
    public function getEtatdv()
    {
        return $this->etatdv;
    }

    /**
     * @param string $etatdv
     */
    public function setEtatdv($etatdv)
    {
        $this->etatdv = $etatdv;
    }


}

