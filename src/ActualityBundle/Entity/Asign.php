<?php

namespace ActualityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Asign
 *
 * @ORM\Table(name="asign")
 * @ORM\Entity(repositoryClass="ActualityBundle\Repository\AsignRepository")
 */
class Asign
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
     * @ORM\ManyToOne(targetEntity="Actualites")
     * @ORM\JoinColumn(name="actualite_id" , referencedColumnName="id")
     */
    private $actualite ;


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
     * @return Asign
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
}
