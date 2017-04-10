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
     * Set comentario
     *
     * @param string $comentario
     *
     * @return Movimiento
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;

        return $this;
    }

    /**
     * Get comentario
     *
     * @return string
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set cantidad
     *
     * @param string $cantidad
     *
     * @return Movimiento
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return string
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set desde
     *
     * @param \DateTime $desde
     *
     * @return Movimiento
     */
    public function setDesde($desde)
    {
        $this->desde = $desde;

        return $this;
    }

    /**
     * Get desde
     *
     * @return \DateTime
     */
    public function getDesde()
    {
        return $this->desde;
    }

    /**
     * Set hasta
     *
     * @param \DateTime $hasta
     *
     * @return Movimiento
     */
    public function setHasta($hasta)
    {
        $this->hasta = $hasta;

        return $this;
    }

    /**
     * Get hasta
     *
     * @return \DateTime
     */
    public function getHasta()
    {
        return $this->hasta;
    }

    /**
     * Set usuario
     *
     * @param \SID\Api\MovementBundle\Entity\User $usuario
     *
     * @return Movimiento
     */
    public function setUsuario(\SID\Api\MovementBundle\Entity\User $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \SID\Api\MovementBundle\Entity\User
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set stock
     *
     * @param \SID\Api\MovementBundle\Entity\Stock $stock
     *
     * @return Movimiento
     */
    public function setStock(\SID\Api\MovementBundle\Entity\Stock $stock = null)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return \SID\Api\MovementBundle\Entity\Stock
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set motivo
     *
     * @param \SID\Api\MovementBundle\Entity\Motivo $motivo
     *
     * @return Movimiento
     */
    public function setMotivo(\SID\Api\MovementBundle\Entity\Motivo $motivo = null)
    {
        $this->motivo = $motivo;

        return $this;
    }

    /**
     * Get motivo
     *
     * @return \SID\Api\MovementBundle\Entity\Motivo
     */
    public function getMotivo()
    {
        return $this->motivo;
    }
}
