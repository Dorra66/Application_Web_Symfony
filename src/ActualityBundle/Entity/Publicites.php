<?php

namespace ActualityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Publicites
 *
 * @ORM\Table(name="publicites")
 * @ORM\Entity(repositoryClass="ActualityBundle\Repository\PublicitesRepository")
 */
class Publicites
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255, nullable=false)
     * @Assert\Length(
     *     min="10",
     *     max="20")
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     * @Assert\Length(
     *     min="20",
     *     max="50")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="imag", type="string", length=255, nullable=false)
     * @Assert\File(
     *     mimeTypes={ "image/jpeg" , "image/png" })
     */
    private $imag;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Publicites
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Publicites
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set imag
     *
     * @param string $imag
     *
     * @return Publicites
     */
    public function setImag($imag)
    {
        $this->imag = $imag;

        return $this;
    }

    /**
     * Get imag
     *
     * @return string
     */
    public function getImag()
    {
        return $this->imag;
    }
}
