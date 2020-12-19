<?php

namespace PlanEventBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="PlanEventBundle\Repository\EventRepository")
 */
class Event
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IdEvent", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idevent;

    /**
     * @var string
     *
     * @ORM\Column(name="NomEvent", type="string", length=50, nullable=false)
     */
    private $nomevent;

    /**
     * @var string
     *
     * @ORM\Column(name="CategorieEvent", type="string", length=50, nullable=false)
     */
    private $categorieevent;

    /**
     * @var integer
     *
     * @ORM\Column(name="NbrPlaceDispo", type="integer", nullable=false)
     */
    private $nbrplacedispo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateEvent", type="date", nullable=false)
     * @Assert\GreaterThan("today")
     */
    private $dateevent;

    /**
     * @var string
     *
     * @ORM\Column(name="HeureEvent", type="string", length=20, nullable=false)
     */
    private $heureevent;

    /**
     * @var string
     *
     * @ORM\Column(name="Affiche", type="string", length=255, nullable=false)
     * @Assert\File(mimeTypes={ "image/jpeg" , "image/png"})
     */
    private $affiche;

    /**
     * @return int
     */
    public function getIdevent()
    {
        return $this->idevent;
    }

    /**
     * @param int $idevent
     */
    public function setIdevent($idevent)
    {
        $this->idevent = $idevent;
    }

    /**
     * @return string
     */
    public function getNomevent()
    {
        return $this->nomevent;
    }

    /**
     * @param string $nomevent
     */
    public function setNomevent($nomevent)
    {
        $this->nomevent = $nomevent;
    }

    /**
     * @return string
     */
    public function getCategorieevent()
    {
        return $this->categorieevent;
    }

    /**
     * @param string $categorieevent
     */
    public function setCategorieevent($categorieevent)
    {
        $this->categorieevent = $categorieevent;
    }

    /**
     * @return int
     */
    public function getNbrplacedispo()
    {
        return $this->nbrplacedispo;
    }

    /**
     * @param int $nbrplacedispo
     */
    public function setNbrplacedispo($nbrplacedispo)
    {
        $this->nbrplacedispo = $nbrplacedispo;
    }

    /**
     * @return \DateTime
     */
    public function getDateevent()
    {
        return $this->dateevent;
    }

    /**
     * @param \DateTime $dateevent
     */
    public function setDateevent($dateevent)
    {
        $this->dateevent = $dateevent;
    }

    /**
     * @return string
     */
    public function getHeureevent()
    {
        return $this->heureevent;
    }

    /**
     * @param string $heureevent
     */
    public function setHeureevent($heureevent)
    {
        $this->heureevent = $heureevent;
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


}
