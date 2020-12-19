<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProdCmd
 *
 * @ORM\Table(name="prod_cmd", indexes={@ORM\Index(name="fk13", columns={"id_prod"}), @ORM\Index(name="fk14", columns={"id_cmd"})})
 * @ORM\Entity
 */
class ProdCmd
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
     * @var integer
     *
     * @ORM\Column(name="id_prod", type="integer", nullable=false)
     */
    private $idProd;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_cmd", type="integer", nullable=false)
     */
    private $idCmd;


}

