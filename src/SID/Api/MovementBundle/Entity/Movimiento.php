<?php

namespace SID\Api\MovementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use SID\Api\UserBundle\Entity\User;
use SID\Api\DrugBundle\Entity\Stock;

/**
 * Movimiento
 *
 * @ORM\Table(name="movimientos")
 * @ORM\Entity(repositoryClass="SID\Api\MovementBundle\Repository\MovimientoRepository")
 */
class Movimiento
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
     * @var string
     *
     * @ORM\Column(name="comentario", type="text", nullable=true)
     */
    private $comentario;

    /**
     * @var string
     *
     * @ORM\Column(name="cantidad", type="string", length=255, nullable=true)
     */
    private $cantidad;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="desde", type="datetime")
     */
    private $desde;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hasta", type="datetime", nullable=true)
     */
    private $hasta;

    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="User", inversedBy="movimientos")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $usuario;

    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="Stock", inversedBy="movimientos")
     * @ORM\JoinColumn(name="movimiento_id", referencedColumnName="id")
     */
    private $stock;

    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="Motivo", inversedBy="movimientos")
     * @ORM\JoinColumn(name="motivo_id", referencedColumnName="id")
     */
    private $motivo;


}

