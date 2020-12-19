<?php

namespace MuseumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Intl\DateFormatter\DateFormat\YearTransformer;

/**
 * Reclamationm
 *
 * @ORM\Table(name="reclamationm")
 * @ORM\Entity(repositoryClass="MuseumBundle\Repository\ReclamationmRepository")
 */
class Reclamationm
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idRM", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrm;

    /**
     * @var string
     *
     * @ORM\Column(name="Idsource", type="string", length=25, nullable=false)
     */
    private $idsource;

    /**
     * @var string
     *
     * @ORM\Column(name="roleSource", type="string", length=50, nullable=false)
     */
    private $rolesource='Client';

    /**
     * @var string
     *
     * @ORM\Column(name="objetReclamation", type="string", length=100, nullable=false)
     */
    private $objetreclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionReclamation", type="string", length=500, nullable=false)
     */
    private $descriptionreclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="dateReclamation", type="string", length=50, nullable=false)
     */
    private $datereclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="statutsReclamation", type="string", length=30, nullable=false)
     */
    private $statutsreclamation='Not seen yet';

    /**
     * @var string
     *
     * @ORM\Column(name="reponseReclamation", type="string", length=500, nullable=false)
     */
    private $reponsereclamation='No response';

    /**
     * @var string
     *
     * @ORM\Column(name="destinationReclamation", type="string", length=50, nullable=false)
     */
    private $destinationreclamation='Admin';

    /**
     * @return int
     */
    public function getIdrm()
    {
        return $this->idrm;
    }

    /**
     * @param int $idrm
     */
    public function setIdrm($idrm)
    {
        $this->idrm = $idrm;
    }

    /**
     * @return string
     */
    public function getIdsource()
    {
        return $this->idsource;
    }

    /**
     * @param string $idsource
     */
    public function setIdsource($idsource)
    {
        $this->idsource = $idsource;
    }

    /**
     * @return string
     */
    public function getRolesource()
    {
        return $this->rolesource;
    }

    /**
     * @param string $rolesource
     */
    public function setRolesource($rolesource)
    {
        $this->rolesource = $rolesource;
    }

    /**
     * @return string
     */
    public function getObjetreclamation()
    {
        return $this->objetreclamation;
    }

    /**
     * @param string $objetreclamation
     */
    public function setObjetreclamation($objetreclamation)
    {
        $this->objetreclamation = $objetreclamation;
    }

    /**
     * @return string
     */
    public function getDescriptionreclamation()
    {
        return $this->descriptionreclamation;
    }

    /**
     * @param string $descriptionreclamation
     */
    public function setDescriptionreclamation($descriptionreclamation)
    {
        $this->descriptionreclamation = $descriptionreclamation;
    }

    /**
     * @return string
     */
    public function getDatereclamation()
    {
        return $this->datereclamation;
    }

    /**
     * @param string $datereclamation
     */
    public function setDatereclamation($datereclamation)
    {
        $this->datereclamation = $datereclamation;
    }

    /**
     * @return string
     */
    public function getStatutsreclamation()
    {
        return $this->statutsreclamation;
    }

    /**
     * @param string $statutsreclamation
     */
    public function setStatutsreclamation($statutsreclamation)
    {
        $this->statutsreclamation = $statutsreclamation;
    }

    /**
     * @return string
     */
    public function getReponsereclamation()
    {
        return $this->reponsereclamation;
    }

    /**
     * @param string $reponsereclamation
     */
    public function setReponsereclamation($reponsereclamation)
    {
        $this->reponsereclamation = $reponsereclamation;
    }

    /**
     * @return string
     */
    public function getDestinationreclamation()
    {
        return $this->destinationreclamation;
    }

    /**
     * @param string $destinationreclamation
     */
    public function setDestinationreclamation($destinationreclamation)
    {
        $this->destinationreclamation = $destinationreclamation;
    }


}

