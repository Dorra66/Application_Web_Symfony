<?php

namespace MuseumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Monument
 *
 * @ORM\Table(name="monument")
 * @ORM\Entity
 */
class Monument
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idM", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idm;

    /**
     * @var string
     *
     * @ORM\Column(name="nomM", type="string", length=70, nullable=false)
     */
    private $nomm;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionM", type="string", length=300, nullable=false)
     */
    private $descriptionm;

    /**
     * @var string
     *
     * @ORM\Column(name="imageM", type="string", length=150, nullable=false)
     * @Assert\NotBlank(message="Add a jpg picture")
     * @Assert\File(mimeTypes={ "image/jpeg","image/jpg" })
     */
    private $imagem;

    /**
     * @return int
     */
    public function getIdm()
    {
        return $this->idm;
    }

    /**
     * @param int $idm
     */
    public function setIdm($idm)
    {
        $this->idm = $idm;
    }

    /**
     * @return string
     */
    public function getNomm()
    {
        return $this->nomm;
    }

    /**
     * @param string $nomm
     */
    public function setNomm($nomm)
    {
        $this->nomm = $nomm;
    }

    /**
     * @return string
     */
    public function getDescriptionm()
    {
        return $this->descriptionm;
    }

    /**
     * @param string $descriptionm
     */
    public function setDescriptionm($descriptionm)
    {
        $this->descriptionm = $descriptionm;
    }

    /**
     * @return string
     */
    public function getImagem()
    {
        return $this->imagem;
    }

    /**
     * @param string $imagem
     */
    public function setImagem($imagem)
    {
        $this->imagem = $imagem;
    }


}

